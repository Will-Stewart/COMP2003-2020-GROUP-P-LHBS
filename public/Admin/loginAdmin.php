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

<div class="content">
        <div class="card">
            <center>
            <h4 class="card-title mb-4 mt-1">Admin - Sign In</h4>
                <form method="POST" action="../../src/Model/adminAuthentication.php">
                    <div class="form-group">
                        <label>Your Username</label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" placeholder="Username" name="adminName">
                        </div>
                    </div> <!-- form-group// -->

                    <div class="form-group">
                        <label>Your Password</label>
                        <div class="col-sm-3">
                        <input type="password" class="form-control" placeholder="********" name="adminPass">
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