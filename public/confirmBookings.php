<?php
include_once 'header.php';
?>

    <section class="container">
        <div>
            <p></p>
        </div>
    </section>

    <div class="container">

        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h3>Selected Booking Details</h3>
                    <form>
                        <div class="form-group row">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="colFormLabel" placeholder="col-form-label">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="colFormLabel" placeholder="Your Name...">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Age</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="colFormLabel">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Clients</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="colFormLabel">
                            </div>
                        </div>
                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-2 pt-0">Rooms</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                        <label class="form-check-label" for="gridRadios1">
                                            Blue Room - (Women)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                        <label class="form-check-label" for="gridRadios2">
                                            Yellow Room - (Men)
                                        </label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3">
                                        <label class="form-check-label" for="gridRadios3">
                                            Green Room - (Couples)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <input class="btn btn-primary" type="submit" value="Confirm">
                    </form>
                </div>
                <div class="col-sm">
                    <h3>Unconfirmed Bookings</h3>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">UNCONFIRMED BOOKING PLACEHOLDER</a>
                        <a href="#" class="list-group-item list-group-item-action">UNCONFIRMED BOOKING PLACEHOLDER</a>
                        <a href="#" class="list-group-item list-group-item-action">UNCONFIRMED BOOKING PLACEHOLDER</a>
                    </div>
                </div>
                <div class="col-sm">
                    <h3>Confirmed Bookings</h3>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">CONFIRMED BOOKING PLACEHOLDER</a>
                        <a href="#" class="list-group-item list-group-item-action">CONFIRMED BOOKING PLACEHOLDER</a>
                        <a href="#" class="list-group-item list-group-item-action">CONFIRMED BOOKING PLACEHOLDER</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?php
include_once 'footer.php';
?>