<?php
include_once 'header.php';

$servername = "proj-mysql.uopnet.plymouth.ac.uk";
$username = "COMP2003_P";
$password = "YleM560+";

// Create connection
$con = new mysqli($servername, $username, $password);

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //something was posted
    $regID = $_SESSION['RegIDs'];
    $firstname = $_POST['Firstname'];
    $lastname = $_POST['Lastname'];
    $BookingIn = $_POST['BookingIn'];
    $BookingOut = $_POST['BookingOut'];
    $WorkingDays = $_POST['WorkingDays'];
    $Gender = $_POST['Gender'];
    $Age = $_POST['Age'];
    $RoomType = $_POST['RoomType'];
    $NumberofPeople = $_POST['AmountOfPeople'];
    $Price = $_POST['Price'];

    if(!empty($firstname) && !empty($lastname) && !empty($BookingIn) &&
        !empty($BookingOut) && !empty($Gender) && !empty($Age) &&
        !empty($RoomType) && !empty($NumberofPeople) && !empty($Price))
    {

        //save to database
        $query = "insert into comp2003_p.hostelbookings (RegID, First_Name,Last_Name,Booking_StartDate,Booking_EndDate,Gender,Age,AmountOfPeople,Preferred_Room,Price) 
        values ('$regID','$firstname','$lastname','$BookingIn','$BookingOut','$Gender','$Age','$NumberofPeople','$RoomType','$Price')";

        echo "<pre>Debug: $query</pre>\m";
        $result = mysqli_query($con, $query);
        if ( false===$result ) {
            printf("error: %s\n", mysqli_error($con));
        }
        else {
            echo 'done.';
            header("Location: createManageBooking.php");
        }
    }else
    {
        echo "Please enter some valid information! ";
        $days_between = ceil(abs($BookingOut - $BookingIn) / 86400);
        echo round($days_between);
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
                        <h5 class="card-title" align="center">Enter Details</h5>
                        <form method="POST" action="#">
                            <div>
                                <label>Firstname</label>
                                <input type="text" class="form-control" name="Firstname">
                            </div>

                            <div>
                                <label>Lastname</label>
                                <input type="text" class="form-control" name="Lastname">
                            </div>

                            <div>
                                <label>Booking In Date</label>
                                <input type="date" class="form-control" name="BookingIn">
                            </div>

                            <div>
                                <label>Booking Out Date</label>
                                <input type="date" class="form-control" name="BookingOut">
                            </div>

                            <label></label>
                            <div>
                                RoomType:
                                <input type="radio" name="RoomType"
                                    <?php if (isset($RoomType) && $RoomType=="Blue") echo "checked";?>
                                       value="Blue">Blue
                                <input type="radio" name="RoomType"
                                    <?php if (isset($RoomType) && $RoomType=="Green") echo "checked";?>
                                       value="Green">Green
                                <input type="radio" name="RoomType"
                                    <?php if (isset($RoomType) && $RoomType=="Yellow") echo "checked";?>
                                       value="Yellow">Yellow
                            </div>
                            <label></label>
                            <div>
                                <label>Age</label>
                                <input type="number" class="form-control" name="Age">
                            </div>
                            <label></label>
                            <div>
                                Gender:
                                <input type="radio" name="Gender"
                                    <?php if (isset($Gender) && $Gender=="Female") echo "checked";?>
                                       value="Female">Female
                                <input type="radio" name="Gender"
                                    <?php if (isset($Gender) && $Gender=="Male") echo "checked";?>
                                       value="Male">Male
                            </div>
                            <label></label>
                            <div>
                                <label>Amount of People</label>
                                <input type="number" class="form-control" name="AmountOfPeople">
                            </div>

                            <div>
                                <label>Price</label>
                                <input type="number" class="form-control" name="Price">
                            </div>

                            <!--
                            <div>
                                <label for="Firstname" class="col-form-label col-sm-3">Firstname</label>
                                <input type="text" name="Firstname">
                            </div>

                            <div>
                                <label for="Lastname" class="col-form-label col-sm-3">Lastname</label>
                                <input type="text" name="Lastname">
                            </div>

                            <div>
                                <label>Booking In</label>
                                <input type="date" class="form-control" name="BookingIn">
                            </div>

                            <div>
                                <label>Booking Out</label>
                                <input type="date" class="form-control" name="BookingOut">
                            </div>

                            <div>
                                <label for="WorkingDays" class="col-form-label col-sm-3">How many working days?</label>
                                <input type="number", name="WorkingDays">
                            </div>

                            <div>
                                <label for="RoomType" class="col-form-label col-sm-3">Room type</label>
                                <select name="RoomType">
                                    <option value>Select Room</option>
                                    <option value>Blue</option>
                                    <option value>Green</option>
                                    <option value>Yellow</option>
                                </select>
                            </div>

                            <div>
                                <label for="Age" class="col-form-label col-sm-3">Age</label>
                                <input type="number", name="Age">
                            </div>

                            <div>
                                <label for="Gender" class="col-form-label col-sm-3">Gender</label>
                                <select name="Gender">
                                    <option value>Select Gender</option>
                                    <option value>Male</option>
                                    <option value>Female</option>
                                </select>
                            </div>


                            <div>
                                <label for="AmountOfPeople" class="col-form-label col-sm-3">Amount Of People</label>
                                <input type="number", class="form-control", name="AmountOfPeople">
                            </div>

                            <div>
                                <label for="Price" class="col-form-label col-sm-3">Price</label>
                                <input type="text" name="Price" value="32">
                            </div>
                            <label></label>
                            -->
                            <div>
                                <div class="col" align="center">
                                    <input class="btn btn-primary" type="submit" value="Confirm Booking"</a>
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
