<?php
session_start();
?>


<!--Large Banner at the top of the page-->
<div class="jumbotron text-center" style="margin-bottom:-30px; background-color: white">
    <div class="container">
        <h1 class="display-4">ADMIN PORTAL</h1>
        <h3 class="lead">Welcome, <?php echo $_SESSION['nameAdmin']?>! The Admin Portal allows you to navigate to multiple Administrator tools</h3>
        <h3 class="lead">You can add new Admin Users, Manage Volunteer Bookings, & Edit Hostel Data e.g. Prices...</h3>
    </div>
</div>



<?php
include_once '../Headers/header.php';



// do check for admin login
if (!isset($_SESSION["AdminIDs"])) {
    header("location: error.php");
    exit; // prevent further execution, should there be more code that follows
}
?>


<!--Create accessible card links to help make the admin portal easy to navigate-->
<div class="content">

        <!--div to store a link to the admin user manager-->
        <div class="row g-0 bg-light position-relative">
            <div class="col-md-6 mb-md-0 p-md-4">
                <img src="../../assets/img/adminUsersManager.png" class="w-100" alt="...">
            </div>
            <div class="col-md-6 p-4 ps-md-0">
                <h5 class="mt-0">Admin Users Manager</h5>
                <p>The Admin Users Manager will allow you to view the current admin accounts inside the Database,
                    it will also provide you with the means of adding new Admin Users!</p>
                <a href="adminUserManager.php" class="btn btn-primary stretched-link">Manage Admin Users</a>
            </div>
        </div>


        <!--div to store a link to the admin Booking Manager-->
        <div class="row g-0 bg-light position-relative">
            <div class="col-md-6 mb-md-0 p-md-4">
                <img src="../../assets/img/bookingManager.png" class="w-100" alt="...">
            </div>
            <div class="col-md-6 p-4 ps-md-0">
                <h5 class="mt-0">Volunteer Booking Manager</h5>
                <p>The Volunteer Booking Manager will allow you to view bookings made by volunteers and
                also allocate them to rooms if necessary, once done click confirm or deny and move on to the next!</p>
                <a href="adminBookingManager.php" class="btn btn-primary stretched-link">Booking Manager</a>
            </div>
        </div>


        <!--div to store a link to the admin hostel data-->
        <div class="row g-0 bg-light position-relative">
            <div class="col-md-6 mb-md-0 p-md-4">
                <img src="../../assets/img/dataManager.png" class="w-100" alt="...">
            </div>
            <div class="col-md-6 p-4 ps-md-0">
                <h5 class="mt-0">Hostel Data Manager</h5>
                <p>The Hostel Data Manager will allow you to edit the default and discount price for bookings,
                you can also change the amount of beds allocated to each room!</p>
                <a href="editHostelData.php" class="btn btn-primary stretched-link">Hostel Data Manager</a>
            </div>
        </div>
    </div>
<br>

<?php
include_once '../Headers/footer.php';
?>