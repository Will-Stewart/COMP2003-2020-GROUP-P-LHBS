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

<div class="container">
    <div class="row">
            <asi class="card">
                <article class="card-body">
            <form class="row g-3 needs-validation" novalidate>
                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">First name</label>
                    <input type="text" class="form-control" id="validationCustom01" value="Mark" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="validationCustom02" class="form-label">Last name</label>
                    <input type="text" class="form-control" id="validationCustom02" value="Otto" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="validationCustomUsername" class="form-label">Gender</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Please choose a gender.
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom03" class="form-label">Age</label>
                    <input type="text" class="form-control" id="validationCustom03" required>
                    <div class="invalid-feedback">
                        Please provide a valid Age.
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="validationCustom05" class="form-label">AmountOfPeople</label>
                    <input type="text" class="form-control" id="validationCustom05" required>
                    <div class="invalid-feedback">
                        Please provide the amount of people.
                    </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Submit form</button>
                </div>
            </form>
                </article>
    </div> <!-- card.// -->

    </aside> <!-- col.// -->
    <aside class="col-sm-4">

    </aside>
</div>

</body>
</html>

<?php
include_once 'footer.php';
?>
