<?php
include_once '../Headers/header.php';
session_start();

// do check
if (!isset($_SESSION["loggedin"])) {
    header("location: error.php");
    exit; // prevent further execution, should there be more code that follows
}

$servername = "proj-mysql.uopnet.plymouth.ac.uk";
$username = "COMP2003_P";
$password = "YleM560+";

// Create connection
$con = new mysqli($servername, $username, $password);

$def = mysqli_query($con, "SELECT defaultPrice FROM comp2003_p.hostelpricing WHERE DataID = 1") or die(mysqli_error($con));
$result = mysqli_fetch_array($def);
$defaultPrice = $result['defaultPrice'];

$dis = mysqli_query($con, "SELECT discountPrice FROM comp2003_p.hostelpricing WHERE DataID = 1") or die(mysqli_error($con));
$result = mysqli_fetch_array($dis);
$discountPrice = $result['discountPrice'];

//Number of Days staying Calculation
$calcBookingIn = new DateTime($_SESSION['sessionBookingIn']);
$calcBookingOut = new DateTime($_SESSION['sessionBookingOut']);
$days_between_array = date_diff($calcBookingOut, $calcBookingIn);

//Price Calculation
$days_between = intval($days_between_array->format('%d'));

if($_SESSION['sessionWorkingDays'] > 0){
    $DiscountPrice = $_SESSION['sessionWorkingDays'] * $discountPrice;
    $days_between = $days_between - $_SESSION['sessionWorkingDays'];
    $InitialPrice = $days_between * $defaultPrice;
    $Price = $InitialPrice + $DiscountPrice;
}
else
    {
        $InitialPrice = $days_between * $defaultPrice;
        $Price = $InitialPrice;
    }

    //Variable population for Database submission
    $regID = $_SESSION['RegIDs'];
    $Firstname = $_SESSION['sessionFirstName'];
    $Lastname = $_SESSION['sessionLastName'];
    $BookingIn = $_SESSION['sessionBookingIn'];
    $BookingOut = $_SESSION['sessionBookingOut'];
    $Gender = $_SESSION['sessionGender'];
    $Age = $_SESSION['sessionAge'];
    $NumberofPeople = $_SESSION['sessionNumberofPeople'];
    $RoomType = $_SESSION['sessionRoomType'];

    if(isset($_POST['confirmBooking'])) {
        {
            if(!empty($Firstname) && !empty($Lastname) && !empty($BookingIn) &&
                !empty($BookingOut) && !empty($Gender) && !empty($Age) &&
                !empty($NumberofPeople) && !empty($RoomType) && !empty($Price))
            {

                //save to database
                $query = "insert into comp2003_p.hostelbookings (RegID, First_Name,Last_Name,Booking_StartDate,Booking_EndDate,Gender,Age,AmountOfPeople,Preferred_Room,Price) 
            values ('$regID','$Firstname','$Lastname','$BookingIn','$BookingOut','$Gender','$Age','$NumberofPeople','$RoomType','$Price')";

                echo "<pre>Debug: $query</pre>\m";
                $result = mysqli_query($con, $query);
                if ( false===$result ) {
                    printf("error: %s\n", mysqli_error($con));
                }
                else {
                    echo 'done.';
                    header("Location: bookingFeedback.php");

                    session_write_close();
                }
            }else
            {
                echo "Please enter some valid information! ";
            }
        }
        if(isset($_POST['editBooking']))
        {
            header("Location: createBooking.php");
        }
    }
?>

<script>
    function goBack() {
        window.history.back();
    }
</script>

<body class="loggedin">
<div class="container center_div">
    <div class="content">
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title" align="center">Booking Receipt</h3>
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
                            <input type="text" class="form-control" name="Firstname" value="<?php echo "£$Price"; ?>" readonly>

                        </div>
                        <div class="form-group row">
                            <div class="col" align="center">
                                <input class="btn btn-primary" type="submit" name="confirmBooking" value="Confirm Booking">
                            </div>
                        </div>
                    </form>
                    <div class="form-group row">
                        <div class="col" align="center">
                            <input class="btn btn-primary" onclick="goBack()" type="submit" value="Return to Form Edit">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>


<?php
include_once '../Headers/footer.php';
?>
