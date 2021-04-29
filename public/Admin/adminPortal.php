<?php
include_once '../Headers/header.php';

// do check
if (!isset($_SESSION["AdminIDs"])) {
    header("location: error.php");
    exit; // prevent further execution, should there be more code that follows
}
?>

<br>

<div class="container">
    <div class="row align-items-start">
        <div class="col">
            <a class="" href="adminUserManager.php">Manage Admin Users</a>
        </div>
        <div class="col">
            <a class="" href="adminBookingManager.php">Manage Bookings</a>
        </div>
        <div class="col">
            <a class="" href="editHostelData.php">Edit Hostel Data</a>
        </div>
    </div>
</div>

<br>

<?php
include_once '../Headers/footer.php';
?>