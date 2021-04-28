<?php
include_once '../Headers/header.php';
session_start();

$servername = "proj-mysql.uopnet.plymouth.ac.uk";
$username = "COMP2003_P";
$password = "YleM560+";

// Create connection
$con = new mysqli($servername, $username, $password);

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    // Something was posted
    $firstname = $_POST['Firstname'];
    $lastname = $_POST['Lastname'];
    $BookingIn = $_POST['BookingIn'];
    $BookingOut = $_POST['BookingOut'];
    $Gender = $_POST['Gender'];
    $Age = $_POST['Age'];
    $RoomType = $_POST['RoomType'];
    $NumberofPeople = $_POST['AmountOfPeople'];
    $WorkingDays = $_POST['WorkingDays'];

    // Assign session variables
    $_SESSION['sessionFirstName'] = $firstname;
    $_SESSION['sessionLastName'] = $lastname;
    $_SESSION['sessionBookingIn'] = $BookingIn;
    $_SESSION['sessionBookingOut'] = $BookingOut;
    $_SESSION['sessionGender'] = $Gender;
    $_SESSION['sessionAge'] = $Age;
    $_SESSION['sessionRoomType'] = $RoomType;
    $_SESSION['sessionNumberofPeople'] = $NumberofPeople;
    $_SESSION['sessionWorkingDays'] = $WorkingDays;

    //Session Variable Testing - Remove when complete
    echo $_SESSION['sessionFirstName'];
    echo $_SESSION['sessionLastName'];
    echo $_SESSION['sessionBookingIn'];
    echo $_SESSION['sessionBookingOut'];
    echo $_SESSION['sessionGender'];
    echo $_SESSION['sessionAge'];
    echo $_SESSION['sessionRoomType'];
    echo $_SESSION['sessionNumberofPeople'];
    echo $_SESSION['sessionWorkingDays'];

    session_write_close();

    header('Location: bookingReceipt.php');
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
                        <h5 class="card-title" align="center">Enter Details</h5>
                        <form method="POST" action="#">
                            <!--First Name Input-->
                            <div class="form-group row">

                                <label name="Firstname" class="col-form-label col-sm-3 ">First Name:</label>
                                <input type="text" class="form-control" name="Firstname">

                            </div>
                            <!--Last Name Input-->
                            <div class="form-group row">

                                <label name="Lastname" class="col-form-label col-sm-3">Last Name:</label>
                                <input type="text" class="form-control" name="Lastname">

                            </div>
                            <!--Booking In Date Input-->
                            <div class="form-group row">

                                <label name="date" class="col-form-label col-sm-3">Booking in date:</label>
                                <input type="date" class="form-control" name="BookingIn">

                            </div>
                            <!--Booking Out Date Input-->
                            <div class="form-group row">

                                <label name="date" class="col-form-label col-sm-3">Checking out date:</label>
                                <input type="date" class="form-control" name="BookingOut">

                            </div>
                            <!--Gender Input-->
                            <div class="form-group row">

                                <label name="Gender" class="col-form-label col-sm-3">Gender:</label>
                                <select name="Gender" class="form-control">
                                    <option value>select gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>

                            </div>
                            <!--Age Input-->
                            <div class="form-group row">

                                <label name="Age" class="col-form-label col-sm-3">Age:</label>
                                <input type="number" class="form-control" name="Age">

                            </div>
                            <!--No. of People Input-->
                            <div class="form-group row">

                                <label name="AmountOfPeople" class="col-form-label col-sm-3">Amount Of People:</label>
                                <input type="number" class="form-control" name="AmountOfPeople">

                            </div>
                            <!--Room Type Input-->
                            <div class="form-group row">

                                <label name="select" class="col-form-label col-sm-3">Room type:</label>
                                <select name="RoomType" class="form-control">
                                    <option value>select room</option>
                                    <option value="Blue">Blue</option>
                                    <option value="Green">Green</option>
                                    <option value="Yellow">Yellow</option>
                                </select>

                            </div>
                            <!--Volunteering Days-->
                            <div class="form-group row">

                                <label name="WorkingDays" class="col-form-label ">Number of days expecting to work:</label>
                                <input type="text" name ="WorkingDays" class="form-control">

                            </div>
                            <div class="form-group row">
                                <div class="col" align="center">
                                    <input class="btn btn-primary" type="submit" value="Create Booking">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
</div>


<?php
include_once '../Headers/footer.php';
?>
