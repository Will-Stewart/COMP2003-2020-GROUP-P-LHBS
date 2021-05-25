<?php
session_start();
?>


<!--Large Banner at the top of the page-->
<div class="jumbotron text-center" style="margin-bottom:-30px; background-color: white">
    <div class="container">
        <h1 class="display-4">VOLUNTEER BOOKING MANAGER</h1>
        <p class="lead">Welcome, <?php echo $_SESSION['name']?>! Here you can update any bookings that are not yet confirmed!</p>
    </div>
</div>



<?php
include_once '../Headers/header.php';


//Store database connection details
$servername = "proj-mysql.uopnet.plymouth.ac.uk";
$username = "COMP2003_P";
$password = "YleM560+";



// Create connection
$con = new mysqli($servername, $username, $password);



//Retrieve the logged in users ID
$id = $_SESSION['RegIDs'];



//SQL statements to retrieve the Denied, Unconfirmed, and Confirmed Bookings from the Hostel Bookings Table
$showDenied = "select BookingID, First_Name, Last_Name, Booking_StartDate, Booking_EndDate, Gender, Preferred_Room, Age, AmountOfPeople, Price from comp2003_p.bookings where Confirmation = 'Cancelled' && RegID = $id ";
$showUnconfirmed = "select BookingID, First_Name, Last_Name, Booking_StartDate, Booking_EndDate, Gender, Preferred_Room, Age, AmountOfPeople, Working_Days, Price from comp2003_p.bookings where Confirmation = 'Unconfirmed' && RegID = $id ";
$showConfirmed = "select BookingID, First_Name, Last_Name, Booking_StartDate, Booking_EndDate, Gender, Preferred_Room, Age, AmountOfPeople, Working_Days, Price from comp2003_p.bookings where Confirmation = 'Confirmed' && RegID = $id";

//Store the query results
$result = mysqli_query($con, $showUnconfirmed);
$resultConfirmed = mysqli_query($con, $showConfirmed);
$resultDenied = mysqli_query($con, $showDenied);


//Listens for when the user submits their edited data
if(isset($_POST['submitEdit'])) {


    //Store the edited values in variables
    $selectedBookingID = $_POST['editBookingID'];
    $selectedFirstname = $_POST['editFirstName'];
    $selectedLastname = $_POST['editLastName'];
    $selectedBookingIn = $_POST['editBookingStartDate'];
    $selectedBookingOut = $_POST['editBookingEndDate'];
    $selectedRoomType = $_POST['editRoomType'];
    $selectedAge = $_POST['editAge'];
    $selectedAdultAge = $_POST['editAdultAge'];
    $selectedWorkingDays = $_POST['editWorkingDays'];
    $selectedAmountOfPeople = $_POST['editNumOfPeople'];
    $selectedGender = $_POST['editGender'];





    //Number of Days staying Calculation
    $calcBookingIn = new DateTime($selectedBookingIn);
    $calcBookingOut = new DateTime($selectedBookingOut);
    $days_between_array = date_diff($calcBookingOut, $calcBookingIn);

    //Price Calculation
    $days_between = intval($days_between_array->format('%d'));




    //Retrieve the Default and Discount Prices for Bookings from the Database
    $def = mysqli_query($con, "SELECT defaultPrice FROM comp2003_p.hostel_prices WHERE DataID = 1") or die(mysqli_error($con));
    $result = mysqli_fetch_array($def);
    $defaultPrice = $result['defaultPrice'];

    $dis = mysqli_query($con, "SELECT discountPrice FROM comp2003_p.hostel_prices WHERE DataID = 1") or die(mysqli_error($con));
    $result = mysqli_fetch_array($dis);
    $discountPrice = $result['discountPrice'];



    //Calculate the price of the Booking
    if($selectedWorkingDays > 0){
        $DiscountPrice = $selectedWorkingDays * $discountPrice;
        $days_between = $days_between - $selectedWorkingDays;
        $InitialPrice = $days_between * $defaultPrice;
        $Price = ($InitialPrice + $DiscountPrice) * $selectedAmountOfPeople;
    }
    else
    {
        $InitialPrice = $days_between * $defaultPrice;
        $Price = $InitialPrice * $selectedAmountOfPeople;
    }




    //Run IF Statements to check if the data that has been input is correct
    if($selectedWorkingDays < $days_between OR $selectedWorkingDays < 0){
        if($selectedBookingIn < $selectedBookingOut){
            if($selectedAmountOfPeople > 0 OR $selectedAmountOfPeople <= 4){
                if($selectedAge < 16 && $selectedAdultAge < 16 && $selectedAmountOfPeople <= 1)
                {
                    header("Location: manageBooking.php");
                }
                elseif($selectedAge < 16 && $selectedAdultAge >= 16 && $selectedAmountOfPeople >= 2)
                {

                    //Update the select values inside the database
                    $query = "UPDATE comp2003_p.bookings SET First_Name = '$selectedFirstname', Last_Name = '$selectedLastname', Booking_StartDate = '$selectedBookingIn', Booking_EndDate = '$selectedBookingOut', 
                                     Preferred_Room = '$selectedRoomType', Age = $selectedAge, Working_Days = $selectedWorkingDays, 
                                     AmountOfPeople = $selectedAmountOfPeople, Gender = '$selectedGender', Price = $Price WHERE BookingID = $selectedBookingID";

                    $resultOrder = mysqli_query($con, $query);

                    if (false===$resultOrder)
                    {
                        printf("error: %s\n", mysqli_error($con));
                    }
                    else
                    {
                        header("Location: manageBookings.php");
                    }
                }
                else
                {
                    //Update the select values inside the database
                    $query = "UPDATE comp2003_p.bookings SET First_Name = '$selectedFirstname', Last_Name = '$selectedLastname', Booking_StartDate = '$selectedBookingIn', Booking_EndDate = '$selectedBookingOut', 
                                     Preferred_Room = '$selectedRoomType', Age = $selectedAge, Working_Days = $selectedWorkingDays, 
                                     AmountOfPeople = $selectedAmountOfPeople, Gender = '$selectedGender', Price = $Price WHERE BookingID = $selectedBookingID";

                    $resultOrder = mysqli_query($con, $query);

                    if (false===$resultOrder)
                    {
                        printf("error: %s\n", mysqli_error($con));
                    }
                    else
                    {
                        header("Location: manageBookings.php");
                    }
                }
            }
        }
    }
}

//If cancel button selected, delete booking from database!
if(isset($_POST['cancelBooking'])) {
    $query = "DELETE FROM comp2003_p.bookings WHERE BookingID = $selectedBookingID";
}

?>


<!--Javascript used to store the values from the form text boxes into temp variables-->
<script type="text/javascript">

    //unconfirmed bookings table
    $(document).ready(function($) {
        $("#unconfirmedBookingsTable tr").click(function() {

            //variable to store the values from the table
            var tempBookingID = $(this).find("td:nth-child(1)").text();
            var tempFirstName = $(this).find("td:nth-child(2)").text();
            var tempLastName = $(this).find("td:nth-child(3)").text();
            var tempBookingIn = $(this).find("td:nth-child(4)").text();
            var tempBookingOut = $(this).find("td:nth-child(5)").text();
            var tempRoomType = $(this).find("td:nth-child(6)").text();
            var tempAge = $(this).find("td:nth-child(7)").text();
            var tempAmountOfPeople = $(this).find("td:nth-child(8)").text();
            var tempWorkingDays = $(this).find("td:nth-child(9)").text();
            var tempGender = $(this).find("td:nth-child(10)").text();
            var tempPrice = $(this).find("td:nth-child(11)").text();
            //leaving out


            //setting the values of the fields to the stored variables
            $("#editBookingID").val(tempBookingID);
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

            $("#editNumOfPeople").val(tempAmountOfPeople);

            $("#editWorkingDays").val(tempWorkingDays);

            if(tempGender === "Male") {
                radiobtnMale.checked = true;
                radiobtnFemale.checked = false;
            }
            else if(tempGender === "Female"){
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

            //setting the values so it's write as well
            formsWriteAndRead();
        });





        $("#confirmedBookingsTable tr").click(function() {
            //variables to store the values from the table
            var tempBookingID = $(this).find("td:nth-child(1)").text();
            var tempFirstName = $(this).find("td:nth-child(2)").text();
            var tempLastName = $(this).find("td:nth-child(3)").text();
            var tempBookingIn = $(this).find("td:nth-child(4)").text();
            var tempBookingOut = $(this).find("td:nth-child(5)").text();
            var tempRoomType = $(this).find("td:nth-child(6)").text();
            var tempAge = $(this).find("td:nth-child(7)").text();
            var tempAmountOfPeople = $(this).find("td:nth-child(8)").text();
            var tempWorkingDays = $(this).find("td:nth-child(9)").text();
            var tempGender = $(this).find("td:nth-child(10)").text();
            var tempPrice = $(this).find("td:nth-child(11)").text();
            //leaving out


            //setting the values of the fields to the stored variables
            $("#editBookingID").val(tempBookingID);
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

            $("#editNumOfPeople").val(tempAmountOfPeople);

            $("#editWorkingDays").val(tempWorkingDays);

            if(tempGender === "Male") {
                radiobtnMale.checked = true;
                radiobtnFemale.checked = false;
            }
            else if(tempGender === "Female"){
                radiobtnMale.checked = false;
                radiobtnFemale.checked = true;
            }
            else{
                radiobtnMale.checked = false;
                radiobtnFemale.checked = false;
            }

            $("#editPrice").val("£" + tempPrice);


            //changing the fields to read only for the confirmed bookings
            formsReadOnly();
        });

        $("#resetButton").click(function() {
            formsWriteAndRead();
            $("#submitButton").prop("disabled", false);
        });
    });

    //Disables and sets certain text boxes to readonly when the user selects either Unconfirmed or Confirmed table rows
    function formsWriteAndRead(){
        $("#submitButton").prop("disabled", false);
        $("#editBookingID").prop("readonly", true);
        $("#editFirstName").prop("disabled", false);
        $("#editLastName").prop("disabled", false);
        $("#editBookingStartDate").prop("disabled", false);
        $("#editBookingEndDate").prop("disabled", false);
        $("#editBlueRoom").prop("disabled",false);
        $("#editYellowRoom").prop("disabled",false);
        $("#editGreenRoom").prop("disabled",false);
        $("#editAge").prop("disabled", false);
        $("#editAdultAge").prop("disabled", false);
        $("#editNumOfPeople").prop("disabled", false);
        $("#editWorkingDays").prop("disabled", false);
        $("#editGenderMale").prop("disabled", false);
        $("#editGenderFemale").prop("disabled", false);
    }


    function formsReadOnly(){
        $("#editBookingID").prop("readonly", true);
        $("#editFirstName").prop("readonly", true);
        $("#editLastName").prop("readonly", true);
        $("#editBookingStartDate").prop("readonly", true);
        $("#editBookingEndDate").prop("readonly", true);
        $("#editBlueRoom").prop("disabled",true);
        $("#editYellowRoom").prop("disabled",true);
        $("#editGreenRoom").prop("disabled",true);
        $("#editAge").prop("readonly", true);
        $("#editAdultAge").prop("readonly", true);
        $("#editNumOfPeople").prop("readonly", true);
        $("#editWorkingDays").prop("readonly", true);
        $("#editGenderMale").prop("disabled", true);
        $("#editGenderFemale").prop("disabled", true);
        $("#submitButton").prop("disabled", true);
    }
</script>



<!--Sets the Accompanying Adult text box to disabled if the age is 16 or greater-->
<script type="text/javascript">
    $(document).change(function() {
        var volAge =  document.getElementById('editAge').value;

        if (volAge >= 16) {
            $("#editAdultAge").prop("disabled", true);
        }
        else {
            $("#editAdultAge").prop("disabled", false);
        }

    });
</script>





<!--Creating a new form for which the table data will be saved in-->
<div class="content">
    <div class="col-sm">
        <h3 class="card-title" align="center">Edit Your Booking Details!</h3>
        <br>
        <form action="#" method="post" class="was-validated">


            <!--Booking ID Form Box-->
            <div class="form-group row" style="display: none">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Booking ID</label>
                <div class="col-sm-4">
                    <label for="editBookingID"></label><input type="text" class="form-control" name="editBookingID" id="editBookingID" placeholder="Booking ID" readonly>
                </div>
            </div>


            <!--Firstname Form Box-->
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-4">
                    <label for="editFirstName"></label><input type="text" class="form-control" name="editFirstName" id="editFirstName" placeholder="First Name" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please choose a First Name!
                    </div>
                </div>
            </div>


            <!--Lastname Form Box-->
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-4">
                    <label for="editLastName"></label><input type="text" class="form-control" name="editLastName" id="editLastName" placeholder="Last Name" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please choose a Last Name!
                    </div>
                </div>
            </div>


            <!--Booking Start Date Form Box-->
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Booking Start Date</label>
                <div class="col-sm-4">
                    <label for="editBookingStartDate"></label><input type="date" class="form-control" name="editBookingStartDate" id="editBookingStartDate" placeholder="col-form-label" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please choose a Booking Start Date!
                    </div>
                </div>
            </div>


            <!--Booking End Date Form Box-->
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Booking End Date</label>
                <div class="col-sm-10">
                    <label for="editBookingEndDate"></label><input type="date" class="form-control" name="editBookingEndDate" id="editBookingEndDate" placeholder="col-form-label" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please choose a Booking End Date!
                    </div>
                </div>
            </div>


            <!--Room Types Form Box-->
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Rooms</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <label for="editBlueRoom"></label><input class="form-check-input" type="radio" name="editRoomType" value="Blue" id="editBlueRoom" required>
                            <label class="form-check-label" for="gridRadios1">
                                Blue Room - (Women)
                            </label>
                        </div>

                        <div class="form-check">
                            <label for="editYellowRoom"></label><input class="form-check-input" type="radio" name="editRoomType" value="Yellow" id="editYellowRoom" required>
                            <label class="form-check-label" for="gridRadios2">
                                Yellow Room - (Men)
                            </label>
                        </div>

                        <div class="form-check">
                            <label for="editGreenRoom"></label><input class="form-check-input" type="radio" name="editRoomType" value="Green" id="editGreenRoom" required>
                            <label class="form-check-label" for="gridRadios3">
                                Green Room - (Couples)
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>


            <!--User Age Form Box-->
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Age</label>
                <div class="col-sm-4">
                    <label for="editAge"></label><input type="number" class="form-control" name="editAge" id="editAge" min="10" max="85" required>
                    <div class="valid-feedback">
                        Looks Good!
                    </div>
                    <div class="invalid-feedback">
                        Age must be either 10 or older!
                    </div>
                </div>
            </div>


            <!--Accompanying Adult Input-->
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 col-form-label">Age of accompanying person:</label>
                <div class="col-sm-6">
                    <label for="editAdultAge"></label><input type="number" class="form-control" name="editAdultAge" id="editAdultAge" min="16" max="85" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Must be either 16 or above!
                    </div>
                </div>
            </div>


            <!--Working Days Form Input-->
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 col-form-label">Working Days:</label>
                <div class="col-sm-6">
                    <label for="editWorkingDays"></label><input type="number" class="form-control" name="editWorkingDays" id="editWorkingDays" min="0" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        How many days do you plan to work? IF ANY!
                    </div>
                </div>
            </div>


            <!--Number of People Input-->
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Amount of People</label>
                <div class="col-sm-7">
                    <label for="editNumOfPeople"></label><input type="number" class="form-control" name="editNumOfPeople" id="editNumOfPeople" min="1" max="4" required>
                    <div class="valid-feedback">
                        Looks Good!
                    </div>
                    <div class="invalid-feedback">
                        Please choose how many people will be staying (1-4) - Minimum of 2 if Age is below 16!
                    </div>
                </div>
            </div>


            <!--Gender Form Input-->
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <label for="editGenderMale"></label><input class="form-check-input" type="radio" name="editGender" id="editGenderMale" value="Male">
                            <label class="form-check-label" for="gridRadios1">
                                Male
                            </label>
                        </div>

                        <div class="form-check">
                            <label for="editGenderFemale"></label><input class="form-check-input" type="radio" name="editGender" id="editGenderFemale" value="Female">
                            <label class="form-check-label" for="gridRadios2">
                                Female
                            </label>
                        </div>

                    </div>
                </div>
            </fieldset>


            <!--Price Form Input-->
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-4">
                    <input type="text" readonly class="form-control" id="editPrice" value="£">
                </div>
            </div>


            <!--Confirm, Discard, Cancel Form Buttons-->
            <div class="form-group">
                <div class="col" align="right">
                    <input class="btn btn-primary" id="submitButton" name="submitEdit" type="submit" value="Confirm Changes">
                    <input class="btn btn-primary" id="resetButton" name="restForm" type="reset" value="Discard Changes">
                    <input class="btn btn-primary" id="cancelBooking" name="cancelBooking" type="reset" value="Cancel Booking">
                </div>
            </div>

        </form>
    </div>
</div>


<!DOCTYPE html>
<html lang="en">
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
            cursor: auto;
        }
    </style>


    <br>


    <!--Table for unconfirmed bookings-->
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <h3>Unconfirmed Bookings - Select a Booking Here!</h3>
                <div class="list-group">
                    <table class="table table-hover table-sm"  id="unconfirmedBookingsTable">
                        <thead>
                        <tr class="table-confirm">
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Booking Start Date</th>
                            <th scope="col">Booking End Date</th>
                            <th scope="col">Room Type</th>
                            <th scope="col">Age</th>
                            <th scope="col">Amount of People</th>
                            <th scope="col">Working Days</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($result-> num_rows > 0){
                            while($row = $result-> fetch_assoc()){
                            echo "<tr>
                            <td style='display: none'>". $row["BookingID"] ."</td>
                            <td>". $row["First_Name"] ."</td>
                            <td>". $row["Last_Name"]. "</td>
                            <td>". $row["Booking_StartDate"]. "</td>
                            <td>". $row["Booking_EndDate"]."</td>
                            <td>". $row["Preferred_Room"]."</td>
                            <td>". $row["Age"] ."</td>
                            <td>". $row["AmountOfPeople"] ."</td>
                            <td>". $row["Working_Days"] ."</td>
                            <td>". $row["Gender"]."</td>
                            <td>". $row["Price"]."</td>
                            </tr>";
                            }
                            echo "</table>";
                        }
                        else{
                            echo "<tr>
                            <td>". "N/A" ."</td>
                            <td>". "N/A" ."</td>
                            <td>". "N/A". "</td>
                            <td>". "N/A". "</td>
                            <td>". "N/A"."</td>
                            <td>". "N/A"."</td>
                            <td>". "N/A" ."</td>
                            <td>". "N/A" ."</td>
                            <td>". "N/A" ."</td>
                            </t>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>






    <br>






    <!--Table for confirmed bookings-->
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <h3>Confirmed Bookings</h3>
                <div class="list-group">
                    <table class="table table-hover table-sm" id="confirmedBookingsTable">
                        <thead>
                        <tr class="table-confirm">
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Booking Start Date</th>
                            <th scope="col">Booking End Date</th>
                            <th scope="col">Room Type</th>
                            <th scope="col">Age</th>
                            <th scope="col">Amount of People</th>
                            <th scope="col">Working Days</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($resultConfirmed-> num_rows > 0){
                            while($row = $resultConfirmed-> fetch_assoc()){
                                //if completed bookings need viewing add in class name and probably separate fields for viewing
                            echo "<tr>
                            <td style='display: none'>". $row["BookingID"] ."</td>
                            <td>". $row["First_Name"] ."</td>
                            <td>". $row["Last_Name"]. "</td>
                            <td>". $row["Booking_StartDate"]. "</td>
                            <td>". $row["Booking_EndDate"]."</td>
                            <td>". $row["Preferred_Room"]."</td>
                            <td>". $row["Age"] ."</td>
                            <td>". $row["AmountOfPeople"] ."</td>
                            <td>". $row["Working_Days"] ."</td>
                            <td>". $row["Gender"]."</td>
                            <td>". $row["Price"]."</td>
                            </tr>";
                            }
                        }
                        else{
                            echo "<tr>
                            <td>". "N/A" ."</td>
                            <td>". "N/A". "</td>
                            <td>". "N/A". "</td>
                            <td>". "N/A"."</td>
                            <td>". "N/A"."</td>
                            <td>". "N/A" ."</td>                      
                            <td>". "N/A" ."</td>
                            <td>". "N/A" ."</td>
                            <td>". "N/A"."</td>
                            </t>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>






    <br>






    <!--Table for denied bookings-->
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <h3>Cancelled Bookings</h3>
                <div class="list-group">
                    <table class="table table-hover table-sm" id="deniedBookingsTable">
                        <thead>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Booking Start Date</th>
                            <th scope="col">Booking End Date</th>
                            <th scope="col">Room Type</th>
                            <th scope="col">Age</th>
                            <th scope="col">Amount of People</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($resultDenied-> num_rows > 0){
                            while($row = $resultDenied-> fetch_assoc()){
                                //if completed bookings need viewing add in class name and probably separate fields for viewing
                                echo "<tr>
                                    <td>". $row["First_Name"] ."</td>
                                    <td>". $row["Last_Name"]. "</td>
                                    <td>". $row["Booking_StartDate"]. "</td>
                                    <td>". $row["Booking_EndDate"]."</td>
                                    <td>". $row["Preferred_Room"]."</td>
                                    <td>". $row["Age"] ."</td>
                                    <td>". $row["AmountOfPeople"] ."</td>
                                    <td>". $row["Gender"]."</td>
                                    <td>". $row["Price"]."</td>
                                    </tr>";
                            }
                            echo "</table>";
                        }
                        else{
                            echo "<tr>
                                    <td>". "N/A" ."</td>
                                    <td>". "N/A" ."</td>
                                    <td>". "N/A". "</td>
                                    <td>". "N/A". "</td>
                                    <td>". "N/A"."</td>
                                    <td>". "N/A"."</td>
                                    <td>". "N/A" ."</td>
                                    <td>". "N/A" ."</td>
                                    <td>". "N/A"."</td>
                                    </t>";
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