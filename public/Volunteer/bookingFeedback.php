<div class="jumbotron text-center" style="margin-bottom:-30px; background-color: white">
    <div class="container">
        <h1 class="display-4">BOOKING COMPLETED!</h1>
        <h4 class="lead">Thanks you for your support!</h4>
    </div>
</div>


<?php
include_once '../Headers/header.php';

// do check
if (!isset($_SESSION["loggedin"])) {
    header("location: error.php");
    exit; // prevent further execution, should there be more code that follows
}
?>

<div class="content">
    <div class="row g-0 bg-light position-relative">
        <div class="col-md-6 mb-md-0 p-md-4">
            <img src="../../assets/img/aboutTrain.jpg" class="w-100" alt="...">
        </div>
        <div class="col-md-6 p-4 ps-md-0">
            <h5 class="mt-0">Booking Confirmation!</h5>
            <p>Thank you for choosing the llechfan Hostel as your place of stay!
                If you have chosen to volunteer and help out, we greatly appreciate
                it! Click the link below if you wish to monitor and manage your bookings!</p>
            <a href="manageBookings.php" class="btn btn-primary stretched-link">Visit Your Booking Manager</a>
        </div>
    </div>
</div>

<?php
include_once '../Headers/footer.php';
?>