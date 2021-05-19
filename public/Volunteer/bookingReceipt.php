<!--Large Banner at the top of the page-->
<div class="jumbotron text-center" style="margin-bottom:-30px; background-color: white">
    <div class="container">
        <h1 class="display-4">BOOKING RECEIPT!</h1>
        <h4 class="lead">Check your details and hit confirm!</h4>
    </div>
</div>



<?php
include_once '../Headers/header.php';


session_start();


// do check for user log in
if (!isset($_SESSION["loggedin"])) {
    header("location: error.php");
    exit; // prevent further execution, should there be more code that follows
}



//Database Connection
$servername = "proj-mysql.uopnet.plymouth.ac.uk";
$username = "COMP2003_P";
$password = "YleM560+";

// Create connection
$con = new mysqli($servername, $username, $password);


    //Retrieve the Default and Discount Price of bookings from the Hostel Pricing Table
    $def = mysqli_query($con, "SELECT defaultPrice FROM comp2003_p.hostel_prices WHERE DataID = 1") or die(mysqli_error($con));
    $result = mysqli_fetch_array($def);
    $defaultPrice = $result['defaultPrice'];

    $dis = mysqli_query($con, "SELECT discountPrice FROM comp2003_p.hostel_prices WHERE DataID = 1") or die(mysqli_error($con));
    $result = mysqli_fetch_array($dis);
    $discountPrice = $result['discountPrice'];


    //Number of Days staying Calculation
    $calcBookingIn = new DateTime($_SESSION['sessionBookingIn']);
    $calcBookingOut = new DateTime($_SESSION['sessionBookingOut']);
    $days_between_array = date_diff($calcBookingOut, $calcBookingIn);

    //Price Calculation
    $days_between = intval($days_between_array->format('%d'));



//Calculate both the Initial Price and Discount Price
if($_SESSION['sessionWorkingDays'] > 0){
    $DiscountPrice = $_SESSION['sessionWorkingDays'] * $discountPrice;
    $days_between = $days_between - $_SESSION['sessionWorkingDays'];
    $InitialPrice = $days_between * $defaultPrice;
    $Price = ($InitialPrice + $DiscountPrice) * $_SESSION['sessionNumberofPeople'];;
}
else
    {
        $InitialPrice = $days_between * $defaultPrice;
        $Price = $InitialPrice * $_SESSION['sessionNumberofPeople'];
    }


    //Variable population for Database submission
    $regID = $_SESSION['RegIDs'];
    $Firstname = $_SESSION['sessionFirstName'];
    $Lastname = $_SESSION['sessionLastName'];
    $BookingIn = $_SESSION['sessionBookingIn'];
    $BookingOut = $_SESSION['sessionBookingOut'];
    $Gender = $_SESSION['sessionGender'];
    $Age = $_SESSION['sessionAge'];
    $adultAge = $_SESSION['sessionAdultAge'];
    $NumberofPeople = $_SESSION['sessionNumberofPeople'];
    $RoomType = $_SESSION['sessionRoomType'];
    $WorkingDays = $_SESSION['sessionWorkingDays'];



//If user confirms booking, check if text boxes are empty and store bookings details in database
if(isset($_POST['confirmBooking'])) {
    {
        //check if text boxes are empty
        if(!empty($Firstname) && !empty($Lastname) && !empty($BookingIn) &&
            !empty($BookingOut) && !empty($Gender) && !empty($Age) &&
            !empty($NumberofPeople) && !empty($RoomType) && !empty($Price))
        {

            //save to database
            $query = "insert into comp2003_p.bookings (RegID, First_Name,Last_Name,Booking_StartDate,Booking_EndDate,Gender,Age,AmountOfPeople,Preferred_Room, Working_Days, Price) 
                        values ('$regID','$Firstname','$Lastname','$BookingIn','$BookingOut','$Gender','$Age','$NumberofPeople','$RoomType','$WorkingDays','$Price')";


            $result = mysqli_query($con, $query);
            if ( false===$result ) {
                printf("error: %s\n", mysqli_error($con));
            }
            else {
                header("Location: bookingFeedback.php");
                session_write_close();
            }
        }else
        {
            echo "Please enter some valid information! ";
        }
    }

}

?>

<script type="text/javascript">
    function goBack() {
        setTimeout("history.go(-1);", 5);
    }
</script>

<!--Form to store details from create bookings page-->
<div class="content">
    <div class="col-sm">
        <h3 class="card-title" align="center">Booking Receipt</h3>
            <h5 class="card-title" align="center">Please check that these details are correct</h5>
                <form method="POST" action="#">
                    <div class="container" align="center">
                    <!--First Name Input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-12 col-form-label">First Name:  <b><?php echo $_SESSION['sessionFirstName'];?></b></label>
                    </div>


                    <!--Last Name Input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-12 col-form-label">Last Name:     <b><?php echo $_SESSION['sessionLastName']; ?></b></label>
                    </div>


                    <!--Booking In Date Input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-12 col-form-label">Booking in date:   <b><?php echo $_SESSION['sessionBookingIn']; ?></b></label>
                    </div>


                    <!--Booking Out Date Input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-12 col-form-label">Checking out date:     <b><?php echo $_SESSION['sessionBookingOut']; ?></b></label>
                    </div>


                    <!--Gender Input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-12 col-form-label">Gender:    <b><?php echo $_SESSION['sessionGender']; ?></b></label>
                    </div>


                    <!--Age Input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-12 col-form-label">Age:   <b><?php echo $_SESSION['sessionAge']; ?></b></label>
                    </div>


                    <!--Accompanying Adult Age Input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-12 col-form-label">Accompanying Adult Age:    <b><?php echo $_SESSION['sessionAdultAge']; ?></b></label>
                    </div>


                    <!--No. of People Input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-12 col-form-label">Amount Of People:  <b><?php echo $_SESSION['sessionNumberofPeople']; ?></b></label>
                    </div>


                    <!--Room Type Input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-12 col-form-label">Room type:     <b><?php echo $_SESSION['sessionRoomType']; ?></b></label>
                    </div>


                    <!--Volunteering Days-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-12 col-form-label">Number of days expecting to work:  <b><?php echo $_SESSION['sessionWorkingDays']; ?></b></label>
                    </div>


                    <!--Total Cost Input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-12 col-form-label">Total Cost:  <b><?php echo "£$Price"; ?></b></label>
                    </div>
                    </div>

                    <!--Confirm Booking Button-->
                    <div class="form-group row">
                        <div class="col" align="center">
                            <input class="btn btn-primary" type="submit" id="confirmBooking" name="confirmBooking" value="Confirm Booking">
                            <input class="btn btn-primary" type="submit" onclick="goBack()" value="Edit Booking">
                        </div>
                    </div>
                </form>
            </div>
        </div>


<?php
include_once '../Headers/footer.php';
?>
