<?php
include_once '../Headers/header.php';

// do check
if (!isset($_SESSION["adminLoggedin"])) {
    header("location: error.php");
    exit; // prevent further execution, should there be more code that follows
}

$servername = "proj-mysql.uopnet.plymouth.ac.uk";
$username = "COMP2003_P";
$password = "YleM560+";

// Create connection
$con = new mysqli($servername, $username, $password);


$sql = "select DataID, defaultPrice, discountPrice from comp2003_p.hostelpricing";
$sql2 = "select RoomID, RoomType, TotalBeds from comp2003_p.roomtypes";

$result = mysqli_query($con, $sql);
$result2 = mysqli_query($con, $sql2);

if(isset($_POST['submitEdit'])) {
    $selectedDefaultPrice = $_POST['editDefaultPrice'];
    $selectedDiscountPrice = $_POST['editDiscountPrice'];

    $query = "UPDATE comp2003_p.hostelpricing SET defaultPrice = $selectedDefaultPrice, discountPrice = $selectedDiscountPrice";

    $resultOrder = mysqli_query($con, $query);
    if ( false===$resultOrder ) {
        printf("error: %s\n", mysqli_error($con));
    }
}

if(isset($_POST['submitRoomEdit'])) {

    $selectedRoomID = $_POST['editRoomID'];
    $selectedRoomType = $_POST['editRoomType'];
    $selectedTotalBeds = $_POST['editTotalBeds'];

    $query = "UPDATE comp2003_p.roomtypes SET RoomType = '$selectedRoomType', TotalBeds = $selectedTotalBeds WHERE RoomID = $selectedRoomID";

    $resultOrder = mysqli_query($con, $query);
    if ( false===$resultOrder ) {
        printf("error: %s\n", mysqli_error($con));
    }
}

?>

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

<div class="container center_div">
    <div class="row">
        <div class="col-sm">
            <br>
            <h3>Hostel Booking Price Manager</h3>
            <form action="#" method="post">
                <br>
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Data ID</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" name="editDataID" id="editDataID" placeholder="..." readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Default Price</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" name="editDefaultPrice" id="editDefaultPrice" placeholder="...">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Discount Price</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" name="editDiscountPrice" id="editDiscountPrice" placeholder="...">
                    </div>
                </div>
                <br>
                <div>
                    <input class="btn btn-primary" type="submit" name="submitEdit" value="Confirm Changes">
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
</head>
</html>


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

<div class="container">
    <div class="row">
        <div class="col-sm">
            <br>
            <h3>Hostel Booking Room Manager</h3>
            <form action="#" method="post">
                <br>
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Room ID</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" name="editRoomID" id="editRoomID" placeholder="..." readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Room Type</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="editRoomType" id="editRoomType" placeholder="...">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Total Beds</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" name="editTotalBeds" id="editTotalBeds" placeholder="...">
                    </div>
                </div>
                <br>
                <div>
                    <input class="btn btn-primary" type="submit" name="submitRoomEdit" value="Confirm Changes">
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
</head>
</html>

<?php
include_once '../Headers/footer.php';
?>
