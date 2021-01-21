<?php
include_once 'header.php';
?>

<div class="container">
    <div class="card mb-3">
        <img src="../assets/img/DEVELOPMENT.png" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">PAGE IS CURRENTLY UNDER DEVELOPMENT!</h5>
            <p class="card-text">This is the Admin Login page, this is where Wardens of the Hostel Booking System can enter their details and gain access on a Admin account.
                The form below is where they can enter their details!</p>
            <p class="card-text"><small class="text-muted">Last updated 21/01/2021</small></p>
        </div>
    </div>
</div>

    <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto" href="#">LHBS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<!--This is the admin login form-->

<div class="container">
    <br>  <p class="text-center">This is where LHBS Admins should login, Users please go to the user log in page at: <a href="loginUser.php"> User Login</a></p>
    <hr>

    <div class="row">
        <aside class="col-sm-4">
            <div class="card">
                <article class="card-body">
                    <h4 class="card-title mb-4 mt-1">Admin- Sign in</h4>
                    <form>
                        <div class="form-group">
                            <label>Your username</label>
                            <input type="text" class="form-control" placeholder="Username" id="">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <a class="float-right" href="#">Forgot?</a>
                            <label>Your password</label>
                            <input type="password" class="form-control" placeholder="********" id="">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <a class="float-right" href="#">Forgot?</a>
                            <label>Your Security Key</label>
                            <input type="text" class="form-control" placeholder="1234567" id="">
                        </div>
                        <div class="form-group">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> Login  </button>
                        </div> <!-- form-group// -->
                    </form>
                </article>
            </div> <!-- card.// -->

        </aside> <!-- col.// -->
        <aside class="col-sm-4">

        </aside>
    </div>





</div>
</html>

<?php
include_once 'footer.php';
?>