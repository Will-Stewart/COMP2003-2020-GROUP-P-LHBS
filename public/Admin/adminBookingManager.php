<?php
include_once '../Headers/header.php';

// do check
if (!isset($_SESSION["AdminIDs"])) {
    header("location: error.php");
    exit; // prevent further execution, should there be more code that follows
}

$servername = "proj-mysql.uopnet.plymouth.ac.uk";
$username = "COMP2003_P";
$password = "YleM560+";

// Create connection
$con = new mysqli($servername, $username, $password);

$sql = "select BookingID, First_Name, Last_Name, Booking_StartDate, Booking_EndDate, Preferred_Room from comp2003_p.hostelbookings where Confirmation = 'Unconfirmed' ";
$sql2 = "select BookingID, First_Name, Last_Name, Booking_StartDate, Booking_EndDate from comp2003_p.hostelbookings where Confirmation = 'Confirmed' ";

if(isset($_POST['confirmOrder'])) {

    $selectedBookingID = $_POST['editBookingID'];
    $selectedRoomType = $_POST['RoomType'];

    $query = "UPDATE comp2003_p.hostelbookings SET Preferred_Room = '$selectedRoomType', Confirmation = 'Confirmed' WHERE BookingID = '$selectedBookingID'";

    echo "<pre>Debug: $query</pre>\m";
    $resultOrder = mysqli_query($con, $query);
    if ( false===$resultOrder ) {
        printf("error: %s\n", mysqli_error($con));
    }
    else {
        echo 'done.';
        header("Location: adminBookingManager.php");
    }
}

$result = mysqli_query($con, $sql);
$resultConfirmed = mysqli_query($con, $sql2);

if(isset($_POST['denyBooking'])) {

    $selectedBookingID = $_POST['editBookingID'];

    $query = "UPDATE comp2003_p.hostelbookings SET Confirmation = 'Denied' WHERE BookingID = '$selectedBookingID'";

    echo "<pre>Debug: $query</pre>\m";
    $resultOrder = mysqli_query($con, $query);
    if ( false===$resultOrder )
    {
        printf("error: %s\n", mysqli_error($con));
    }
    else
        {
            echo 'done.';
            header("Location: adminBookingManager.php");
        }
}

?>

<script type="text/javascript">
    $(document).ready(function($) {
        $("#unconfirmedBookingsEdit tr").click(function() {
            //variable to store the bookingID from the row clicked
            var tempBookingID = $(this).find("td:nth-child(1)").text();
            var tempFirstName = $(this).find("td:nth-child(2)").text();
            var tempLastName = $(this).find("td:nth-child(3)").text();
            var tempBookingIn = $(this).find("td:nth-child(4)").text();
            var tempBookingOut = $(this).find("td:nth-child(5)").text();
            var tempRoomType = $(this).find("td:nth-child(6)").text();

            //php script to get all the values from the database where bookingID = tempBookingID
            // and store them in global variables

            //setting the values of the fields to the stored variables
            $("#editBookingID").val(tempBookingID);
            $("#editFirstName").val(tempFirstName);
            $("#editLastName").val(tempLastName);
            $("#editBookingStartDate").val(tempBookingIn);
            $("#editBookingEndDate").val(tempBookingOut);

            radiobtnBlue = document.getElementById("editBlueRoom");
            radiobtnYellow = document.getElementById("editYellowRoom");
            radiobtnGreen = document.getElementById("editGreenRoom");

            if(tempRoomType === 'Blue'){
                radiobtnBlue.checked = true;
                radiobtnYellow.checked = false;
                radiobtnGreen.checked = false;
            }
            else if(tempRoomType === "Yellow"){
                radiobtnYellow.checked = true;
                radiobtnBlue.checked = false;
                radiobtnGreen.checked = false;
            }
            else if(tempRoomType === 'Green'){
                radiobtnGreen.checked = true;
                radiobtnYellow.checked = false;
                radiobtnBlue.checked = false;
            }
            else{
                radiobtnBlue.checked = false;
                radiobtnYellow.checked = false;
                radiobtnGreen.checked = false;
            }

        });
    });
</script>

<div class="container center_div">
    <div class="row">
        <div class="col-sm">
            <br>
            <h3>Admin Booking Manager</h3>
            <br>
            <form action="#" method="post">
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Booking ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="editBookingID" id="editBookingID" placeholder="ID" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="editFirstName" placeholder="..." readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="editLastName" placeholder="..." readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Booking Start Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="editBookingStartDate" placeholder="col-form-label" readonly>
                    </div>
                </div>
                <div>
                    RoomType:
                    <input type="radio" name="RoomType" id="editBlueRoom"
                        <?php if (isset($RoomType) && $RoomType=="Blue") echo "checked";?>
                           value="Blue">Blue

                    <input type="radio" name="RoomType" id="editGreenRoom"
                        <?php if (isset($RoomType) && $RoomType=="Green") echo "checked";?>
                           value="Green">Green

                    <input type="radio" name="RoomType" id="editYellowRoom"
                        <?php if (isset($RoomType) && $RoomType=="Yellow") echo "checked";?>
                           value="Yellow">Yellow
                </div>
                <br>
                <div>
                    <input class="btn btn-primary" name="confirmOrder" type="submit" value="Confirm Booking">
                </div>
                <div>
                    <input class="btn btn-primary" name="denyBooking" type="submit" value="Deny Booking">
                </div>
            </form>
        </div>
    </div>
</div>

<br>

<!DOCTYPE html>
<html>
<head>
    <style>
        table{
            border-collapse: collapse;
            width: 100%;
            color: #d96459;
            font-family: sans-serif;
            font-size: 16px;
            text-align: left;
        }
        th{
            background-color: #2f3947;
            color: white;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <h3>Unconfirmed Bookings</h3>
                <div class="list-group">
                    <table class="table table-hover" id="unconfirmedBookingsEdit">
                        <thead>
                        <tr class="table-confirm">
                            <th scope="col">Booking ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Booking Start Date</th>
                            <th scope="col">Booking End Date</th>
                            <th scope="col">Room Type</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($result-> num_rows > 0){
                            while($row = $result-> fetch_assoc()){
                                echo "<tr name='table-row'>
                                       <td class='td1'>". $row["BookingID"] ."</td>
                                       <td class='td2'>". $row["First_Name"] ."</td>
                                       <td class='td3'>". $row["Last_Name"] . "</td>
                                       <td class='td4'>". $row["Booking_StartDate"] . "</td>
                                       <td class='td5'>". $row["Booking_EndDate"] ."</td>
                                       <td class='td6'>". $row["Preferred_Room"] ."</td>
                                       </tr>";
                            }
                            echo "</table>";
                        }
                        else{
                            echo $result + "results";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <h3>Confirmed Bookings</h3>
                <div class="list-group">
                    <table class="table table-hover">
                        <thead>
                        <tr class="table-confirm">
                            <th scope="col">Booking ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Booking Start Date</th>
                            <th scope="col">Booking End Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($resultConfirmed-> num_rows > 0){
                            while($row = $resultConfirmed-> fetch_assoc()){
                                //if completed bookings need viewing add in class name and probably separate fields for viewing
                                echo
                                    "<tr><td>"
                                    . $row["BookingID"]
                                    ."</td><td>". $row["First_Name"]
                                    ."</td><td>". $row["Last_Name"]
                                    ."</td><td>". $row["Booking_StartDate"]
                                    ."</td><td>". $row["Booking_EndDate"]."</td></t>";
                            }
                            echo "</table>";
                        }
                        else{
                            echo "";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</head>

<?php
include_once '../Headers/footer.php';
?>
