<?php
include_once 'header.php';
session_start();

$servername = "proj-mysql.uopnet.plymouth.ac.uk";
$username = "COMP2003_P";
$password = "YleM560+";

// Create connection
$con = new mysqli($servername, $username, $password);

//Number of Days staying Calculation
$calcBookingIn = new DateTime($_SESSION['sessionBookingIn']);
$calcBookingOut = new DateTime($_SESSION['sessionBookingOut']);
$days_between_array = date_diff($calcBookingOut, $calcBookingIn);

//Price Calculation
$BasePrice = 10;
$days_between = intval($days_between_array->format('%d'));
$InitialPrice  = $days_between * $BasePrice;
$DiscountPrice = $_SESSION['sessionWorkingDays'] * 7;
$Price = $InitialPrice - $DiscountPrice;

//Variable population for Database submission
$Firstname = $_SESSION['sessionFirstName'];
$Lastname = $_SESSION['sessionLastName'];
$BookingIn = $_SESSION['sessionBookingIn'];
$BookingOut = $_SESSION['sessionBookingOut'];
$Gender = $_SESSION['sessionGender'];
$Age = $_SESSION['sessionAge'];
$NumberofPeople = $_SESSION['sessionNumberofPeople'];
$RoomType = $_SESSION['sessionRoomType'];


if($_SERVER['REQUEST_METHOD'] == "POST")
{

    if(!empty($Firstname) && !empty($Lastname) && !empty($BookingIn) &&
        !empty($BookingOut) && !empty($Gender) && !empty($Age) &&
        !empty($NumberofPeople) && !empty($RoomType) && !empty($Price))
    {

        //save to database
        $query = "insert into comp2003_p.hostelbookings (First_Name,Last_Name,Booking_StartDate,Booking_EndDate,Gender,Age,AmountOfPeople,Preferred_Room,Price) 
        values ('$Firstname','$Lastname','$BookingIn','$BookingOut','$Gender','$Age','$NumberofPeople','$RoomType','$Price')";

        echo "<pre>Debug: $query</pre>\m";
        $result = mysqli_query($con, $query);
        if ( false===$result ) {
            printf("error: %s\n", mysqli_error($con));
        }
        else {
            echo 'done.';
            header("Location: createManageBooking.php");

            session_write_close();
        }
    }else
    {
        echo "Please enter some valid information! ";
    }
}
?>

<div class="container">
    <div class="card mb-3">
        <img src="../assets/img/DEVELOPMENT.png" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">PAGE IS CURRENTLY UNDER DEVELOPMENT!</h5>
            <p class="card-text">This page is going to contain a Booking Form which allows Volunteers/Non Volunteers to create a booking in order to stay at the Talyllyn Railway Hostel.
                Beneath this you can see a basic interpretation of what we want to achieve and what this page is going to contain!</p>
            <p class="card-text"><small class="text-muted">Last updated 21/01/2021</small></p>
        </div>
    </div>
</div>
<!--^^to be deleted once done-->

<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" align="center">My bookings</h5>
                    <div class="card-header">Approved Bookings</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Booking 1</li>
                        <li class="list-group-item">Booking 2</li>
                    </ul>
                    <div class="card-header">Pending Bookings</div>
                    <ul class="list-group">
                        <li class="list-group-item">Unapproved Booking 1</li>
                        <li class="list-group-item">Unapproved Booking 2</li>
                    </ul>
                    <br>

                    <a href="#" class="btn btn-primary">[+] New Booking </a>
                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" align="center">Please check that these details are correct</h5>
                    <form method="POST" action="#">
                        <!--First Name Input-->
                        <div class="form-group row">

                            <label name="Firstname" class="col-form-label col-sm-3 ">First Name:</label>
                            <input type="text" class="form-control" name="Firstname" value="<?php echo $_SESSION['sessionFirstName']; ?>" readonly>

                        </div>
                        <!--Last Name Input-->
                        <div class="form-group row">

                            <label name="Lastname" class="col-form-label col-sm-3">Last Name:</label>
                            <input type="text" class="form-control" name="Lastname" value="<?php echo $_SESSION['sessionLastName']; ?>" readonly>

                        </div>
                        <!--Booking In Date Input-->
                        <div class="form-group row">

                            <label name="date" class="col-form-label col-sm-3">Booking in date:</label>
                            <input type="date" class="form-control" name="BookingIn" value="<?php echo $_SESSION['sessionBookingIn']; ?>" readonly>

                        </div>
                        <!--Booking Out Date Input-->
                        <div class="form-group row">

                            <label name="date" class="col-form-label col-sm-3">Checking out date:</label>
                            <input type="date" class="form-control" name="BookingOut" value="<?php echo $_SESSION['sessionBookingOut']; ?>" readonly>

                        </div>
                        <!--Gender Input-->
                        <div class="form-group row">

                            <label name="Gender" class="col-form-label col-sm-3">Gender:</label>
                            <input type="text" class="form-control" name="Gender" value="<?php echo $_SESSION['sessionGender']; ?>" readonly>
                        </div>
                        <!--Age Input-->
                        <div class="form-group row">

                            <label name="Age" class="col-form-label col-sm-3">Age:</label>
                            <input type="number" class="form-control" name="Age" value="<?php echo $_SESSION['sessionAge']; ?>" readonly>

                        </div>
                        <!--No. of People Input-->
                        <div class="form-group row">

                            <label name="AmountOfPeople" class="col-form-label col-sm-3">Amount Of People:</label>
                            <input type="number" class="form-control" name="AmountOfPeople" value="<?php echo $_SESSION['sessionNumberofPeople']; ?>" readonly>

                        </div>
                        <!--Room Type Input-->
                        <div class="form-group row">

                            <label name="select" class="col-form-label col-sm-3">Room type:</label>
                            <input type="text" class="form-control" name="RoomType" value="<?php echo $_SESSION['sessionRoomType']; ?>" readonly>

                        </div>
                        <!--Volunteering Days-->
                        <div class="form-group row">

                            <label name="VolunteeringDays" class="col-form-label ">Number of days expecting to work:</label>
                            <input type="text" name ="VolunteeringDays" class="form-control" value="<?php echo $_SESSION['sessionWorkingDays']; ?>" readonly>

                        </div>
                        <!--First Name Input-->
                        <div class="form-group row">

                            <label name="Price" class="col-form-label ">On arrival you will be expected to pay the sum of:</label>
                            <input type="text" class="form-control" name="Firstname" value="<?php echo $Price; ?>" readonly>

                        </div>
                        <div class="form-group row">
                            <div class="col" align="center">
                                <input class="btn btn-primary" type="submit" value="Confirm Booking">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col" align="center">
                                <input class="btn btn-primary" type="button" value="Edit Booking" onclick="">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<?php
include_once 'footer.php';
?>
