<!--Large Banner at the top of the page-->
<div class="jumbotron text-center" style="margin-bottom:-30px; background-color: white">
    <div class="container">
        <h1 class="display-4">HOSTEL DATA MANAGER</h1>
        <h3 class="lead">The Hostel Data Manager allows you to change the default/discount price for volunteers</h3>
        <h3 class="lead">You can also edit the amount of beds for each room!</h3>
    </div>
</div>




<?php
include_once '../Headers/header.php';



// do check dor admin login
if (!isset($_SESSION["adminLoggedin"])) {
    header("location: error.php");
    exit; // prevent further execution, should there be more code that follows
}


    //store database connection details
    $servername = "proj-mysql.uopnet.plymouth.ac.uk";
    $username = "COMP2003_P";
    $password = "YleM560+";

    // Create connection
    $con = new mysqli($servername, $username, $password);


    //SQL Queries to retrieve booking data and room data
    $sql = "select DataID, defaultPrice, discountPrice from comp2003_p.hostelpricing";
    $sql2 = "select RoomID, RoomType, TotalBeds from comp2003_p.roomtypes";


    //Store query results
    $result = mysqli_query($con, $sql);
    $result2 = mysqli_query($con, $sql2);


//If the warden submits the price edited data, run code
if(isset($_POST['submitEdit'])) {


    //store default and discount price in varibles
    $selectedDefaultPrice = $_POST['editDefaultPrice'];
    $selectedDiscountPrice = $_POST['editDiscountPrice'];


    //Update the default price/discount price in hostel pricing table
    $query = "UPDATE comp2003_p.hostelpricing SET defaultPrice = $selectedDefaultPrice, discountPrice = $selectedDiscountPrice";

    $resultOrder = mysqli_query($con, $query);
    if ( false===$resultOrder ) {
        printf("error: %s\n", mysqli_error($con));
    }
}

//If the warden submits the room edited data, run code
if(isset($_POST['submitRoomEdit'])) {


    //store text box data inside variables
    $selectedRoomID = $_POST['editRoomID'];
    $selectedRoomType = $_POST['editRoomType'];
    $selectedTotalBeds = $_POST['editTotalBeds'];


    //SQL Quuery to update room names, and total beds for those rooms
    $query = "UPDATE comp2003_p.roomtypes SET RoomType = '$selectedRoomType', TotalBeds = $selectedTotalBeds WHERE RoomID = $selectedRoomID";

    $resultOrder = mysqli_query($con, $query);
    if ( false===$resultOrder ) {
        printf("error: %s\n", mysqli_error($con));
    }
}

?>



<!--Javascript to store form data in temp variables and display them-->
<script type="text/javascript">
    $(document).ready(function($) {
        $("#editPriceData tr").click(function() {
            //variable to store the bookingID from the row clicked
            var tempDataID = $(this).find("td:nth-child(1)").text();
            var tempDefaultPrice = $(this).find("td:nth-child(2)").text();
            var tempDiscountPrice = $(this).find("td:nth-child(3)").text();

            //php script to get all the values from the database where bookingID = tempBookingID
            // and store them in global variables

            //setting the values of the fields to the stored variables
            $("#editDataID").val(tempDataID);
            $("#editDefaultPrice").val(tempDefaultPrice);
            $("#editDiscountPrice").val(tempDiscountPrice);

        });
    });
</script>





<!--Contains the forms for the Price Manager and Room Manager-->
<div class="container">
    <div class="content">
        <div class="row">
            <div class="col-sm">
                <br>
                <h3>Hostel Booking Price Manager</h3>
                <form action="#" method="post" class="was-validated">
                    <br>


                    <!--Data Id form input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Data ID</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" name="editDataID" id="editDataID" placeholder="..." readonly>
                        </div>
                    </div>


                    <!--Default Price form input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Default Price</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" name="editDefaultPrice" id="editDefaultPrice" min="10" placeholder="..." required>
                            <div class="valid-feedback">
                                Default Price is good!
                            </div>
                            <div class="invalid-feedback">
                                Please input a default price!
                            </div>
                        </div>
                    </div>


                    <!--Discoutn Price form input-->
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Discount Price</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" name="editDiscountPrice" id="editDiscountPrice" min="3" placeholder="..." required>
                            <div class="valid-feedback">
                                Discount Price is good!
                            </div>
                            <div class="invalid-feedback">
                                Please input a discount price!
                            </div>
                        </div>
                    </div>


                    <br>
                    <div>
                        <input class="btn btn-primary" type="submit" name="submitEdit" value="Confirm Changes">
                    </div>
                </form>
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




<!--Table to display the Default and Discount booking prices-->
<h3>Hostel Pricing Information</h3>
    <div class="list-group">
        <table class="table table-hover" id="editPriceData">
            <thead>
            <tr class="table-confirm">
                <th scope="col">Data ID</th>
                <th scope="col">Default Price</th>
                <th scope="col">Discount Price<th>
            </tr>
                </thead>
                  <tbody>
                    <?php
                    if($result-> num_rows > 0){
                        while($row = $result-> fetch_assoc()){
                            echo "<tr name='table-row'>
                                       <td class='td1'>". $row["DataID"] ."</td>
                                       <td class='td2'>". $row["defaultPrice"] ."</td>
                                       <td class='td3'>". $row["discountPrice"] . "</td>
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



<!--Javascript to store Hostel Room Data and display them in the text boxes-->
<script type="text/javascript">
    $(document).ready(function($) {
        $("#editRoomsData tr").click(function() {
            //variable to store the bookingID from the row clicked
            var tempRoomID = $(this).find("td:nth-child(1)").text();
            var tempRoomType = $(this).find("td:nth-child(2)").text();
            var tempTotalBeds = $(this).find("td:nth-child(3)").text();

            //php script to get all the values from the database where bookingID = tempBookingID
            // and store them in global variables

            //setting the values of the fields to the stored variables
            $("#editRoomID").val(tempRoomID);
            $("#editRoomType").val(tempRoomType);
            $("#editTotalBeds").val(tempTotalBeds);

        });
    });
</script>




<!--Form used to present the data from the tables-->
<div class="content">
<div class="row">
    <div class="col-sm">
<br>
    <h3>Hostel Booking Room Manager</h3>
        <form action="#" method="post" class="was-validated">
            <br>


            <!--Room ID form input-->
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Room ID</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" name="editRoomID" id="editRoomID" placeholder="..." readonly>
                </div>
            </div>


            <!--Room Types form input-->
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Room Type</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="editRoomType" id="editRoomType" placeholder="..." required>
                    <div class="valid-feedback">
                        Room Type is looking good!
                    </div>
                    <div class="invalid-feedback">
                        Please choose a room type!
                    </div>
                </div>
            </div>


            <!--Total beds form input-->
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Total Beds</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" name="editTotalBeds" id="editTotalBeds" min="0" placeholder="..." required>
                    <div class="valid-feedback">
                        Looking Good!
                    </div>
                    <div class="invalid-feedback">
                        Please input how many beds are available!
                    </div>
                </div>
            </div>


            <br>
            <div>
                <input class="btn btn-primary" type="submit" name="submitRoomEdit" value="Confirm Changes">
            </div>
        </form>
    <br>






<!--Table used to store room data from the hostel database-->
<h3>Hostel Pricing Information</h3>
<div class="list-group">
    <table class="table table-hover" id="editRoomsData">
        <thead>
        <tr class="table-confirm">
            <th scope="col">Room ID</th>
            <th scope="col">Room Type</th>
            <th scope="col">Total Beds<th>
        </tr>
        </thead>
            <tbody>
                <?php
                    if($result2-> num_rows > 0){
                        while($row = $result2-> fetch_assoc()){
                            echo "<tr name='table-row'>
                                   <td class='td1'>". $row["RoomID"] ."</td>
                                   <td class='td2'>". $row["RoomType"] ."</td>
                                   <td class='td3'>". $row["TotalBeds"] . "</td>
                                   </tr>";
                        }
                        echo "</table>";
                    }
                    else{
                        echo $result2 + "results";
                    }
                ?>
        </tbody>
    </table>
</div>


</div>
</div>
</div>
</div>


</head>
</html>

<?php
include_once '../Headers/footer.php';
?>
