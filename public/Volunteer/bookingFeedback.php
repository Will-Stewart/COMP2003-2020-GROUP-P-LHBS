<?php
include_once '../Headers/header.php';

// do check
if (!isset($_SESSION["loggedin"])) {
    header("location: error.php");
    exit; // prevent further execution, should there be more code that follows
}
?>

<div class="container">
    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Booking Has Been Made!</h1>

    <!-- Intro Content -->
    <div class="row">
        <div class="col-lg-6">
            <img class="img-fluid rounded mb-4" src="../../assets/img/llechfantrain.jpg" alt="">
        </div>
        <div class="col-lg-6">
            <h2>Info</h2>
            <p>Thank you for choosing the llechfan Hostel as your place of stay!</p>
            <p>If you have chosen to volunteer and help out, we greatly appreciate it!</p>
            <p>Click the link below if you wish to monitor and manage your bookings!</p>
            <a href="manageBookings.php">Volunteer Booking Manager</a>
        </div>
    </div>
</div>

<?php
include_once '../Headers/footer.php';
?>