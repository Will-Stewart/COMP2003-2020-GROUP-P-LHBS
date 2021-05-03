<!--Large Banner at the top of the page-->
<div class="jumbotron text-center" style="margin-bottom:-30px; background-color: white">
    <div class="container">
        <h1 class="display-4">ADMIN PORTAL LOGIN</h1>
        <p class="lead">Please insert your Admin Credentials to enter the Admin Manager!</p>
    </div>
</div>



<?php
session_start();

include_once '../Headers/header.php';
?>



<!--Form used to acquire Admin log in details and send the details adminAuthentication.php-->
<div class="content">
        <div class="card">
            <center>
            <h4 class="card-title mb-4 mt-1">Admin - Sign In</h4>
                <form method="POST" action="../../src/Model/adminAuthentication.php" class="was-validated">
                    <div class="form-group">
                        <label>Your Username</label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" placeholder="Username" name="adminName" required>
                            <div class="valid-feedback">
                                Username is looking good!
                            </div>
                            <div class="invalid-feedback">
                                Please insert your Username!
                            </div>
                        </div>
                    </div> <!-- form-group// -->

                    <div class="form-group">
                        <label>Your Password</label>
                        <div class="col-sm-3">
                        <input type="password" class="form-control" placeholder="********" name="adminPass" required>
                            <div class="valid-feedback">
                                Password is looking good!
                            </div>
                            <div class="invalid-feedback">
                                Please insert your Password!
                            </div>
                        </div>
                    </div> <!-- form-group// -->

                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="adminSignin" value="LOGIN">
                    </div> <!-- form-group// -->
                </form>
        </center>
        </div> <!-- card.// -->
</div>




<br>




<?php
include_once '../Headers/footer.php';
?>