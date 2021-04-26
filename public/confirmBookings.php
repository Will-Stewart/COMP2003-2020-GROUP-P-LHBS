<?php
include_once 'header.php';

$servername = "proj-mysql.uopnet.plymouth.ac.uk";
$username = "COMP2003_P";
$password = "YleM560+";

// Create connection
$con = new mysqli($servername, $username, $password);


$id = $_SESSION['RegIDs'];
$BookingID = $_SESSION['BookingID'];

$sql = "select BookingID, First_Name, Last_Name, Booking_StartDate, Booking_EndDate, Gender, Preferred_Room, Age, Price from comp2003_p.hostelbookings where RegID = $id ";
$sql2 = "select BookingID, First_Name, Last_Name, Booking_StartDate, Booking_EndDate, Gender, Preferred_Room, Age, Price from comp2003_p.hostelbookings where Confirmation = 'Confirmed' ";
$sql3 = "select * from comp2003_p.hostelbookings where BookingID = $BookingID";

$result = mysqli_query($con, $sql);
$resultConfirmed = mysqli_query($con, $sql2);
$resultAll = mysqli_query($con, $sql3);

?>
<script type="text/javascript">

    $(document).ready(function($) {
        $("#unconfirmedBookingsTable tr").click(function() {
            //variable to store the bookingID from the row clicked
            var tempBookingID = $(this).find("td:nth-child(1)").text();
            var tempFirstName = $(this).find("td:nth-child(2)").text();
            var tempLastName = $(this).find("td:nth-child(3)").text();
            var tempBookingIn = $(this).find("td:nth-child(4)").text();
            var tempBookingOut = $(this).find("td:nth-child(5)").text();
            var tempRoomType = $(this).find("td:nth-child(6)").text();
            var tempAge = $(this).find("td:nth-child(7)").text();
            var tempGender = $(this).find("td:nth-child(8)").text();
            var tempPrice = $(this).find("td:nth-child(9)").text();
            //leaving out


            //setting the values of the fields to the stored variables
            $("#editFirstName").val(tempFirstName);
            $("#editLastName").val(tempLastName);
            $("#editBookingStartDate").val(tempBookingIn);
            $("#editBookingEndDate").val(tempBookingOut);
            radiobtnBlue = document.getElementById("editBlueRoom");
            radiobtnYellow = document.getElementById("editYellowRoom");
            radiobtnGreen = document.getElementById("editGreenRoom");
            radiobtnMale = document.getElementById("editGenderMale");
            radiobtnFemale = document.getElementById("editGenderFemale");

            if(tempRoomType === "Blue"){
                radiobtnBlue.checked = true;
                radiobtnYellow.checked = false;
                radiobtnGreen.checked = false;
            }
            else if(tempRoomType === "Yellow"){
                radiobtnYellow.checked = true;
                radiobtnBlue.checked = false;
                radiobtnGreen.checked = false;
            }
            else if(tempRoomType === "Green"){
                radiobtnGreen.checked = true;
                radiobtnYellow.checked = false;
                radiobtnBlue.checked = false;
            }
            else{
                radiobtnBlue.checked = false;
                radiobtnYellow.checked = false;
                radiobtnGreen.checked = false;
            }

            $("#editAge").val(tempAge);
            if(tempGender == "Male") {
                radiobtnMale.checked = true;
                radiobtnFemale.checked = false;
            }
            else if(tempGender == "Female"){
                radiobtnMale.checked = false;
                radiobtnFemale.checked = true;
            }
            else{
                radiobtnMale.checked = false;
                radiobtnFemale.checked = false;
            }
            $("#editPrice").val("£" + tempPrice);
            //!!consider taking out £ to make sure the value can
            // be stored in the database (only floats)

        });
    });
</script>
<div class="container center_div">
    <div class="row">
        <div class="col-sm">
            <h3>Selected Booking Details</h3>
            <form>
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="editFirstName" placeholder="First Name">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="editLastName" placeholder="Last Name">
                    </div>
                </div>

                <div class="form-group row">
                       <label for="colFormLabel" class="col-sm-2 col-form-label">Booking Start Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="editBookingStartDate" placeholder="col-form-label">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Booking End Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="editBookingEndDate" placeholder="col-form-label">
                    </div>
                </div>



                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Rooms</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" value="option1" id="editBlueRoom">
                                <label class="form-check-label" for="gridRadios1">
                                    Blue Room - (Women)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" value="option2" id="editYellowRoom">
                                <label class="form-check-label" for="gridRadios2">
                                    Yellow Room - (Men)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" value="option3" id="editGreenRoom">
                                <label class="form-check-label" for="gridRadios3">
                                    Green Room - (Couples)
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Age</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="editAge">
                    </div>
                </div>
                <br>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios2" id="editGenderMale" value="option1">
                                <label class="form-check-label" for="gridRadios1">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios2" id="editGenderFemale" value="option2">
                                <label class="form-check-label" for="gridRadios2">
                                    Female
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>


                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-4">
                        <input type="text" readonly class="form-control" id="editPrice" value="£">
                    </div>
                </div>

                <label></label>
                <div class="form-group row">
                    <input class="btn btn-primary" type="submit" value="Confirm Changes">
                    <input class="btn btn-primary" type="reset" value="Discard Changes">
                </div>
            </form>
        </div>
    </div>
</div>

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
            cursor: pointer;
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
                    <table class="table table-hover"  id="unconfirmedBookingsTable">
                        <thead>
                        <tr class="table-confirm">
                            <th scope="col">Booking ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Booking Start Date</th>
                            <th scope="col">Booking End Date</th>
                            <th scope="col">Room Type</th>
                            <th scope="col">Age</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($result-> num_rows > 0){
                            while($row = $result-> fetch_assoc()){
                                echo "<tr><td>". $row["BookingID"] ."</td><td>". $row["First_Name"] ."</td><td>". $row["Last_Name"]. "</td><td>". $row["Booking_StartDate"]. "</td><td>". $row["Booking_EndDate"]."</td>
                                <td>". $row["Preferred_Room"]."</td><td>". $row["Age"] ."</td><td>". $row["Gender"]."</td><td>". $row["Price"]."</td></t>";
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

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <h3>Confirmed Bookings</h3>
                <div class="list-group">
                    <table class="table">
                        <thead>
                        <tr class="table-confirm">
                            <th scope="col">Booking ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Booking Start Date</th>
                            <th scope="col">Booking End Date</th>
                            <th scope="col">Room Type</th>
                            <th scope="col">Age</th>
                            <th scope="col">Gender</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($resultConfirmed-> num_rows > 0){
                            while($row = $resultConfirmed-> fetch_assoc()){
                                //if completed bookings need viewing add in class name and probably separate fields for viewing
                                echo "<tr><td>". $row["BookingID"] ."</td><td>". $row["First_Name"] ."</td><td>". $row["Last_Name"]. "</td><td>". $row["Booking_StartDate"]. "</td><td>". $row["Booking_EndDate"]."</td></t>";
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
include_once 'footer.php';
?>
