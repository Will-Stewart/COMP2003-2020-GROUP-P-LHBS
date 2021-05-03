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
            $query = "insert into comp2003_p.hostelbookings (RegID, First_Name,Last_Name,Booking_StartDate,Booking_EndDate,Gender,Age,AmountOfPeople,Preferred_Room, Working_Days, Price) 
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

    //Return to previous page
    if(isset($_POST['editBooking']))
    {
        header("Location: createBooking.php");
    }

}
?>



<!--Javascript to return to previous page-->
<script>
    function goBack()
    {
        window.history.back();
    }
</script>




<!--Form to store details from create bookings page-->
<div class="content">
    <div class="col-sm">
        <h3 class="card-title" align="center">Booking Receipt</h3>
            <h5 class="card-title" align="center">Please check that these details are correct</h5>
                <form method="POST" action="#">


                    <!--First Name Input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="Firstname" value="<?php echo $_SESSION['sessionFirstName']; ?>" readonly>
                        </div>
                    </div>


                    <!--Last Name Input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="Lastname" value="<?php echo $_SESSION['sessionLastName']; ?>" readonly>
                        </div>
                    </div>


                    <!--Booking In Date Input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Booking in date:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="BookingIn" value="<?php echo $_SESSION['sessionBookingIn']; ?>" readonly>
                        </div>
                    </div>


                    <!--Booking Out Date Input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Checking out date:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="BookingOut" value="<?php echo $_SESSION['sessionBookingOut']; ?>" readonly>
                        </div>
                    </div>


                    <!--Gender Input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Gender:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="Gender" value="<?php echo $_SESSION['sessionGender']; ?>" readonly>
                        </div>
                    </div>


                    <!--Age Input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Age:</label>
                        <div class="col-sm-8">
                        <input type="number" class="form-control" name="Age" value="<?php echo $_SESSION['sessionAge']; ?>" readonly>
                        </div>
                    </div>


                    <!--Accompanying Adult Age Input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-3 col-form-label">Accompanying Adult Age:</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" name="adultAge" value="<?php echo $_SESSION['sessionAdultAge']; ?>" readonly>
                        </div>
                    </div>


                    <!--No. of People Input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Amount Of People:</label>
                        <div class="col-sm-6">
                        <input type="number" class="form-control" name="AmountOfPeople" value="<?php echo $_SESSION['sessionNumberofPeople']; ?>" readonly>
                        </div>
                    </div>


                    <!--Room Type Input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Room type:</label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" name="RoomType" value="<?php echo $_SESSION['sessionRoomType']; ?>" readonly>
                        </div>
                    </div>


                    <!--Volunteering Days-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Number of days expecting to work:</label>
                        <div class="col-sm-6">
                        <input type="text" name ="VolunteeringDays" class="form-control" value="<?php echo $_SESSION['sessionWorkingDays']; ?>" readonly>
                        </div>
                    </div>


                    <!--Total Cost Input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Total Cost: (Upfront)</label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" name="Firstname" value="<?php echo "£$Price"; ?>" readonly>
                        </div>
                    </div>


                    <!--Confirm Booking Button-->
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


<?php
include_once '../Headers/footer.php';
?>
