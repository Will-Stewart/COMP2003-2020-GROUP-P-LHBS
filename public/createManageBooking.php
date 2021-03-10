<?php
include_once 'header.php';
?>

<div class="container">
    <div class="card mb-3">
        <img src="../assets/img/DEVELOPMENT.png" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">PAGE IS CURRENTLY UNDER DEVELOPMENT!</h5>
            <p class="card-text">This page is going to contain a Booking Form which allows Volunteers/Non Volunteers to create a booking in order to stay at the Talyllyn Railway Hostel.
                Beneath this you can see a basic interpretation of what we want to achieve and what this page is going to contain!</p>
            <p class="card-text"><small class="text-muted">Last updated 21/01/2021</small></p>
        </div>
    </div>
</div>
<!--^^to be deleted once done-->

<div class="container">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title" align="center">My bookings</h5>
                        <div class="card-header">Approved Bookings</div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Booking 1</li>
                            <li class="list-group-item">Booking 2</li>
                        </ul>
                        <div class="card-header">Pending Bookings</div>
                        <ul class="list-group">
                            <li class="list-group-item">Unapproved Booking 1</li>
                            <li class="list-group-item">Unapproved Booking 2</li>
                        </ul>
                        <br>

                        <a href="#" class="btn btn-primary">[+] New Booking </a>
                    </div>
                </div>
            </div>

            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title" align="center">Enter Details</h5>
                        <form>
                            <div class="form-group row">

                                    <label for="date" class="col-form-label col-sm-3">Booking in date</label>
                                    <input type="date" id="date">

                            </div>
                            <div class="form-group row">

                                    <label for="date" class="col-form-label col-sm-3">Checking out date</label>
                                    <input type="date" id="date">

                            </div>
                            <div class="form-group row">
                                <label for="select" class="col-form-label col-sm-3">Room type</label>
                                <select id="select">
                                    <option value>select room</option>
                                    <option value>blue</option>
                                    <option value>green</option>
                                    <option value>red</option>
                                </select>
                            </div>
                            <!--Number of rooms-->
                            <div class="form-group row">
                                <label for="numberOfRooms" class="col-form-label col-sm-3">Number of Rooms</label>
                                <input type="number">
                            </div>
                            <!--Room Price-->
                            <div class="form-group row">
                                <label for="price" class="col-form-label col-sm-3">Price</label>
                                <input type="text" readonly class="form" value="£xx.xx">
                            </div>

                            <div class="form-group row">
                                <div class="col" align="center">
                                    <a href="#" class="btn btn-primary">Confirm booking</a>
                                    <a href="#" class="btn btn-primary">Discard changes</a>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
</div>


<?php
include_once 'footer.php';
?>
