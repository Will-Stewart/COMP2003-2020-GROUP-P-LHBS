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
    if(!empty($Firstname) && !empty($Lastname) && !empty($BookingIn) &&
        !empty($BookingOut) && !empty($Gender) && !empty($Age) &&
        !empty($NumberofPeople) && !empty($RoomType) && !empty($Price))
    {
        echo "Please fill in all the text boxes";
    }
    else
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

            session_write_close();
            header('Location: bookingReceipt.php');
        }

}
?>

<br>


<div class="container">
    <h2>Rooms</h2>
    <div class="row">
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

<body class="loggedin">
<div class="container center_div">
<div class="content">
        <div class="row">
            <div class="col-sm">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title" align="center">Enter Your Booking Details!</h3>
                        <form method="POST" action="#">

                            <!--First Name Input-->
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">First Name:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="Firstname" id="Firstname">
                                </div>
                            </div>

                            <!--Last Name Input-->
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Last Name:</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="Lastname">
                                </div>
                            </div>

                            <!--Booking In Date Input-->
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Booking In:</label>
                                <div class="col-sm-3">
                                <input type="date" class="form-control" name="BookingIn">
                                </div>
                            </div>

                            <!--Booking Out Date Input-->
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Booking Out:</label>
                                <div class="col-sm-3">
                                <input type="date" class="form-control" name="BookingOut">
                                </div>
                            </div>

                            <!--Gender Input-->
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Gender:</label>
                                <div class="col-sm-3">
                                <select name="Gender" class="form-control">
                                    <option value>select gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                </div>
                            </div>

                            <!--Age Input-->
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Age:</label>
                                <div class="col-sm-2">
                                <input type="number" class="form-control" name="Age">
                                </div>
                            </div>

                            <!--No. of People Input-->
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Amount of People:</label>
                                <div class="col-sm-2">
                                <input type="number" class="form-control" name="AmountOfPeople">
                                </div>
                            </div>

                            <!--Room Type Input-->
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Room Type:</label>
                                <div class="col-sm-4">
                                <select name="RoomType" class="form-control">
                                    <option value>Select Room</option>
                                    <option value="Blue">Blue</option>
                                    <option value="Green">Green</option>
                                    <option value="Yellow">Yellow</option>
                                </select>
                                </div>
                            </div>

                            <!--Volunteering Days-->
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Number of days expected to work:</label>
                                <div class="col-sm-2">
                                <input type="text" name ="WorkingDays" class="form-control">
                                </div>
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
</div>
</body>

<?php
include_once '../Headers/footer.php';
?>
