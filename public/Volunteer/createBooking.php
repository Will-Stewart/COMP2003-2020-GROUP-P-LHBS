<!--Large Banner at the top of the page-->
<div class="jumbotron text-center" style="margin-bottom:-30px; background-color: white">
    <div class="container">
        <h1 class="display-4">VOLUNTEER BOOKING MANAGER</h1>
        <h4 class="lead">Please fill in the form below if you wish to stay at the Hostel, We greatly appreciate your support!</h4>
        <h4 class="lead">*Make sure to check the booking calendar!*</h4 class="lead">
    </div>
</div>




<?php
include_once '../Headers/header.php';
session_start();



// do check if user is logged in
if (!isset($_SESSION["loggedin"])) {
    header("location: error.php");
    exit; // prevent further execution, should there be more code that follows
}


//Store database connection details
$servername = "proj-mysql.uopnet.plymouth.ac.uk";
$username = "COMP2003_P";
$password = "YleM560+";



// Create connection
$con = new mysqli($servername, $username, $password);


//If user clicks create booking button, store text box data into variables
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //store text box data into variables
    $firstname = $_POST['Firstname'];
    $lastname = $_POST['Lastname'];
    $BookingIn = $_POST['BookingIn'];
    $BookingOut = $_POST['BookingOut'];
    $Gender = $_POST['Gender'];
    $Age = $_POST['volAge'];
    $adultAge = $_POST['volAdultAge'];
    $RoomType = $_POST['RoomType'];
    $NumberofPeople = $_POST['AmountOfPeople'];
    $WorkingDays = $_POST['WorkingDays'];


    //store variables into global variables for easy access
    $_SESSION['sessionFirstName'] = $firstname;
    $_SESSION['sessionLastName'] = $lastname;
    $_SESSION['sessionBookingIn'] = $BookingIn;
    $_SESSION['sessionBookingOut'] = $BookingOut;
    $_SESSION['sessionGender'] = $Gender;
    $_SESSION['sessionAge'] = $Age;
    $_SESSION['sessionAdultAge'] = $adultAge;
    $_SESSION['sessionRoomType'] = $RoomType;
    $_SESSION['sessionNumberofPeople'] = $NumberofPeople;
    $_SESSION['sessionWorkingDays'] = $WorkingDays;


        //Number of Days staying Calculation
        $calcBookingIn = new DateTime($_SESSION['sessionBookingIn']);
        $calcBookingOut = new DateTime($_SESSION['sessionBookingOut']);
        $days_between_array = date_diff($calcBookingOut, $calcBookingIn);


        //store number of days
        $days_between = intval($days_between_array->format('%d'));


//check if text boxes are empty
if(!empty($firstname) && !empty($lastname) && !empty($BookingIn) && !empty($BookingOut) && !empty($Gender) && !empty($Age) && !empty($NumberofPeople) && !empty($RoomType))
    {
    //If statements to support error handling and prevent incorrect data from coming through
    if($WorkingDays <= $days_between OR $WorkingDays < 0){
        if($BookingIn < $BookingOut){
            if($NumberofPeople > 0 OR $NumberofPeople <= 4){
                if($Age < 16 && $adultAge < 16 && $NumberofPeople <= 1)
                {
                    //refresh page
                    header("Refresh:0");
                }
                elseif($Age < 16 && $adultAge >= 16 && $NumberofPeople >= 2)
                {
                    //send user to booking receipt page
                    session_write_close();
                    header('Location: bookingReceipt.php');
                }
                else
                    {
                        //send user to booking receipt page
                        session_write_close();
                        header('Location: bookingReceipt.php');
                    }
                }
            }
        }
    }
}
?>

<?php

function build_calender($month, $year)
{

    //Store database connection details
    $servername = "proj-mysql.uopnet.plymouth.ac.uk";
    $username = "COMP2003_P";
    $password = "YleM560+";


    //Store connection in con variable
    $con = new mysqli($servername, $username, $password);


    //SQL Query to retrieve the year and month from the Booking start date in hostel bookings
    $stmt = $con->prepare('select * from comp2003_p.hostelbookings where MONTH(Booking_StartDate) = ? AND YEAR(Booking_StartDate) = ?');
    $stmt->bind_param('ss', $month, $year);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $bookings[] = $row['Booking_StartDate'];
            }
            $stmt->close();
        }
    }


    //variables to store days of the week, 1st day of the month, number of days in month, month name, day name
    $daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
    $numberDays = date('t', $firstDayOfMonth);
    $dateComponents = getdate($firstDayOfMonth);
    $monthName = $dateComponents['month'];
    $dayOfWeek = $dateComponents['wday'];
    $dateToday = date('Y-m-d');


    //Variables to store the previous month/year and next month/year
    $prev_month = date('m', mktime(0, 0, 0, $month-1, 1, $year));
    $prev_year = date('Y', mktime(0, 0, 0, $month-1, 1, $year));
    $next_month = date('m', mktime(0, 0, 0, $month+1, 1, $year));
    $next_year = date('Y', mktime(0, 0, 0, $month+1, 1, $year));


    //Display month/year, provide buttons to switch months
    $calendar = "<center><h2>$monthName $year</h2><br>";
    $calendar.= "<a class='btn btn-info' href='?month=".$prev_month."&year=".$prev_year." '>Prev Month </a>";
    $calendar.= "<a class='btn btn-info' href='?month=".date('m')."&year=".date('Y')." '>Current Month</a>";
    $calendar.= "<a class='btn btn-info' href='?month=".$next_month."&year=".$next_year." '>Next Month</a></center>";
    $calendar.="<br><table class='table table-bordered'>";
    $calendar.="<tr>";


    //display the days of the week stored in $daysOfWeek array
    foreach ($daysOfWeek as $day) {
        $calendar.="<th class='header'>$day</th>";
    }


    //set current day to 1
    $currentDay = 1;
    $calendar .= "</tr><tr>";



    if($dayOfWeek > 0) {
        for($k=0;$k<$dayOfWeek;$k++){
            $calendar .= "<td  class='empty'></td>";
        }
    }


    $month = str_pad($month, 2, "0",STR_PAD_LEFT);


    //loop through day of the week
    while ($currentDay <= $numberDays) {
        //Seventh column (Saturday) reached. Start a new row.
        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }

        //
        $currentDayRel = str_pad($currentDay, 2, "0",STR_PAD_LEFT);
        $startdate="$year-$month-$currentDayRel";
        $dayStartname = strtolower(date('l', strtotime($startdate)));
        $today = $startdate==date('Y-m-d')? "today" : "";
        $amountPeople = (int)


        //store checkSlots and totalPeople function data into variables
        $totalBookings = checkSlots($con, $startdate);
        $totalPeople = totalPeople($con, $amountPeople);


        //display the amount of bookings remaining on correct dates
        if($totalBookings==24){
            $calendar.= "<td class='$today'><h4>$currentDayRel</h4></td>";
        }
        else
        {
            $availableSlots = 24 - ($totalBookings + $totalPeople);
            $calendar.= "<td class='$today'><h4>$currentDayRel</h4><small><i>$availableSlots slots available</i></small>";
        }

        //increment variable
        $currentDay++;
        $dayOfWeek++;
    }

    if ($dayOfWeek < 7) {
        $remainingDays = 7 - $dayOfWeek;
        for($l=0;$l<$remainingDays;$l++){
            $calendar .= "<td class='empty'></td>";
        }
    }

    $calendar .= "</table>";

    //return calendar function
    return $calendar;
}


//Gets the amount of bookings on selected day
function checkSlots($con, $dateStart){
    $stmt = $con->prepare("select * from comp2003_p.hostelbookings where Booking_StartDate = ?");
    $stmt->bind_param('s', $dateStart);
    $totalBookings = 0;
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $totalBookings++;
            }
            $stmt->close();
        }
    }
    return $totalBookings;
}


//Retrieve the amount of people for that date
function totalPeople($con, $amountPeople){
    $stmt = $con->prepare("select AmountOfPeople from comp2003_p.hostelbookings where AmountOfPeople = ?");
    $stmt->bind_param('s', $amountPeople);
    $totalPeople = 0;
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $totalPeople++;
            }
            $stmt->close();
        }
    }
    return $totalPeople;
}

?>




<!--Javascript to disable adult age text box if volunteer age is >= 16-->
<script type="text/javascript">
    $(document).change(function() {
       var volunteerAge =  document.getElementById('volAge').value;

        if (volunteerAge >= 16) {
            $("#volAdultAge").prop("disabled", true);
        }
        else {
            $("#volAdultAge").prop("disabled", false);
        }

    });
</script>





<br>





<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        @media only screen and (max-width: 760px),
        (min-device-width: 802px) and (max-device-width: 1020px){
            table,
            thead,
            tbody,
            th,
            td,
            tr{
                display: block;
            }

            .empty{
                display: none;
            }

            th{
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr{
                border: 1px solid #cccccc;
            }

            td{
                border: none;
                border-bottom: 1px solid #eeeeee;
                position: relative;
                padding-left: 50%;
            }

            td:nth-of-type(1):before{
                content: "Sunday";
            }

            td:nth-of-type(2):before{
                content: "Monday";
            }

            td:nth-of-type(3):before{
                content: "Tuesday";
            }

            td:nth-of-type(4):before{
                content: "Wednesday";
            }

            td:nth-of-type(5):before{
                content: "Thursday";
            }

            td:nth-of-type(6):before{
                content: "Friday";
            }

            td:nth-of-type(7):before{
                content: "Saturday";
            }

            @media only screen and (min-width: 320px) and (max-device-width: 480px){
                body {
                    padding: 0;
                    margin: 0;
                }
            }

            @media only screen and (min-width: 802px) and (max-device-width: 1020px){
                body {
                    width: 495px;
                }
            }

            @media(min-width:641px){
                table{
                    table-layout: fixed;
                }

                td{
                    width: 33%;
                }
            }

            .row{
                margin-top: 20px;
            }

            .today{
                background: yellow;
            }

        }
    </style>
</head>

    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                $dateComponents = getdate();
                if(isset($_GET['month']) && isset($_GET['year'])){
                    $month = $_GET['month'];
                    $year = $_GET['year'];
                }else
                {
                    $month = $dateComponents['mon'];
                    $year = $dateComponents['year'];
                }

                echo build_calender($month, $year);
                ?>
            </div>
        </div>
    </div>
    </body>
</html>





<br>





<!--Form to store details for our create booking-->
<div class="content">
    <div class="col-sm">
        <h1 align="center">Hostel Booking Form!</h1>
        <br>
            <form id="defaultForm" method="POST" action="#" class="was-validated">


                <!--Firstname form input-->
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">First Name:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="Firstname" id="Firstname" placeholder="John/Jane" pattern="[a-z}" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please insert your First Name!
                        </div>
                    </div>
                </div>



                <!--Last Name Input-->
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Last Name:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="Lastname" placeholder="Doe" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please insert your Last Name!
                        </div>
                    </div>
                </div>



                <!--Booking In Date Input-->
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Booking In:</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" name="BookingIn" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a Booking Start Date!
                        </div>
                    </div>
                </div>



                <!--Booking Out Date Input-->
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Booking Out:</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" name="BookingOut" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a Booking End Date!
                        </div>
                    </div>
                </div>



                <!--Gender Input-->
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Gender:</label>
                    <div class="col-sm-4">
                    <select name="Gender" class="form-control custom-select" required>
                        <option value>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a Gender!
                        </div>
                    </div>
                </div>



                <!--Age Input-->
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Age:</label>
                    <div class="col-sm-7">
                        <input type="number" class="form-control" name="volAge" id="volAge" placeholder="26" min="10" max="85" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Age must be either 10 or older!
                        </div>
                    </div>
                </div>



                <!--Accompanying Person Input-->
                <div id="accomAdult" class="form-group row">
                    <label for="colFormLabel" class="col-sm-3 col-form-label">Age of accompanying person:</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" name="volAdultAge" id="volAdultAge" min="16" max="85" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Must be either 16 or above!
                        </div>
                    </div>
                </div>



                <!--No. of People Input-->
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Amount of People:</label>
                    <div class="col-sm-7">
                        <input type="number" class="form-control" name="AmountOfPeople" placeholder="0" min="1" max="4" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose how many people will be staying (1-4) - Minimum of 2 if Age is below 16!
                        </div>
                    </div>
                </div>



                <!--Room Type Input-->
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Preferred Room:</label>
                    <div class="col-sm-6">
                    <select name="RoomType" class="form-control custom-select" required>
                        <option value>Select Room</option>
                        <option value="Blue">Blue</option>
                        <option value="Green">Green</option>
                        <option value="Yellow">Yellow</option>
                    </select>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please tell us what room you would prefer!
                        </div>
                    </div>
                </div>



                <!--Volunteering Days-->
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Working Days:</label>
                    <div class="col-sm-6">
                        <input type="text" name ="WorkingDays" class="form-control" min="0" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            How many days do you plan to work? IF ANY!
                        </div>
                    </div>
                </div>



                <div class="form-group row">
                    <div class="col" align="right">
                        <input class="btn btn-primary" type="submit" value="Create Booking">
                    </div>
                </div>
            </form>
        </div>
    </div>
<br>






<br>





<!--Display types of rooms at the bottom of the page-->
<div class="container">
    <h2>Type of Rooms Available</h2>
    <div class="row">

        <!--Display Green room information-->
        <div class="col-lg-4 mb-4">
            <div class="card h-100 text-center">
                <img class="card-img-top" src="../../assets/img/green.jpg" alt="Green Room Preview">
                <div class="card-body">
                    <h4 class="card-title">Green Room</h4>
                    <h6 class="card-subtitle mb-2 text-muted">2 Bunks</h6>
                    <p class="card-text">This is the default room for couples.</p>
                </div>
                <div class="card-footer">
                    <p>Hosts up to 4 beds!</p>
                </div>
            </div>
        </div>


        <!--Display Blue room information-->
        <div class="col-lg-4 mb-4">
            <div class="card h-100 text-center">
                <img class="card-img-top" src="../../assets/img/blue.jpg" alt="Blue Room Preview">
                <div class="card-body">
                    <h4 class="card-title">Blue Room</h4>
                    <h6 class="card-subtitle mb-2 text-muted">4 Bunks</h6>
                    <p class="card-text">This is the default room for women.</p>
                </div>
                <div class="card-footer">
                    <p>Hosts up to 8 beds!</p>
                </div>
            </div>
        </div>


        <!--Display Yellow room information-->
        <div class="col-lg-4 mb-4">
            <div class="card h-100 text-center">
                <img class="card-img-top" src="../../assets/img/yellow.jpg" alt="Yellow Room Preview">
                <div class="card-body">
                    <h4 class="card-title">Yellow Room</h4>
                    <h6 class="card-subtitle mb-2 text-muted">6 Bunks</h6>
                    <p class="card-text">This is the default room for men.</p>
                </div>
                <div class="card-footer">
                    <p>Hosts up to 12 beds!</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once '../Headers/footer.php';
?>