<!--banner to be displayed at the top of the page-->
<div class="jumbotron text-center" style="margin-bottom:-30px; background-color: white">
    <div class="container">
        <h1 class="display-4">SUPPORT</h1>
        <h1 class="lead">Learn about the website and how to use it!</h1>
    </div>
</div>



<?php
include_once '../Headers/header.php';
?>



<div class="content">


    <!--Card to inform user about the create bookings page-->
    <div class="card mb-3">
        <img class="card-img-top" src="../../assets/img/createBooking.png" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Create Booking</h5>
            <p class="card-text">The Create Booking page can only be accessed when you have logged in!
            When making a booking, make sure to read the Calendar to check if those days you wish to book are available!
            Once you've picked your dates, fill in the form with your details. If you are below the age of 16, you will be asked to fill another form
            for an adult. A maximum of 4 people can be booked with you, choose the room you prefer (check at the bottom of the page for more details on the room types!).
            If you're going to be working while staying with us, please insert the amount of days you intend to work during your stay.</p>
            <p class="card-text"><small class="text-muted">Last updated - 30/04/2021</small></p>
        </div>
    </div>



    <!--Card to inform user about the manage bookings page-->
    <div class="card mb-3">
        <img class="card-img-top" src="../../assets/img/updateBookings.png" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Manage Bookings</h5>
            <p class="card-text">The Booking Manager will allow you to view any bookings you've made, you'll also be able to
            make changes to a booking you have submitted (unless it has been confirmed). You can also see if your booking has been confirmed!</p>
            <p class="card-text"><small class="text-muted">Last updated - 30/04/2021</small></p>
        </div>
    </div>


</div>



<?php
include_once '../Headers/footer.php';
?>
