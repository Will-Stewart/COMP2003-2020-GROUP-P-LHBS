<?php
include_once 'header.php';
include_once 'developmentNotice.php';
?>

    <div class="container">
        <div class="row">
            <aside class="card">
                <article class="card-body">
                    <form class="row g-3 needs-validation" novalidate style="padding: 8px">
                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label">First name</label>
                            <input type="text" class="form-control" id="validationCustom01" placeholder="Mark" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom02" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="validationCustom02" placeholder="Otto" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustomUsername" class="form-label">Gender</label>
                            <div class="input-group has-validation">
                                <input type="text" class="form-control" id="validationCustomUsername" placeholder="Male" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    Please choose a gender.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="validationCustom03" class="form-label">Age</label>
                            <input type="text" class="form-control" id="validationCustom03" placeholder="25" required>
                            <div class="invalid-feedback">
                                Please provide a valid Age.
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom05" class="form-label">Amount Of People</label>
                            <input type="text" class="form-control" id="validationCustom05" placeholder="4" required>
                            <div class="invalid-feedback">
                                Please provide the amount of people.
                            </div>
                        </div>

                            <div class="col-4">
                                <button class="btn btn-primary" type="submit" >Submit form</button>
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