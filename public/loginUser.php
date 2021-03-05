<?php
include_once 'header.php';
?>

    <div class="container">
        <div class="card mb-3">
            <img src="../assets/img/DEVELOPMENT.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">PAGE IS CURRENTLY UNDER DEVELOPMENT!</h5>
                <p class="card-text">This is the Login page, this is where Volunteers can enter their details and gain access on a Volunteer account. The form below is where they can enter their details!</p>
                <p class="card-text"><small class="text-muted">Last updated 21/01/2021</small></p>
            </div>
        </div>
    </div>

    <!--This is the user login form-->
    <div class="container">
        <br>  <p class="text-center">This is where LHBS users should login, Admins please go to the admin log in page at: <a href="loginAdmin.php"> Admin Login</a></p>
        <hr>


        <div class="row">
            <div class="col-sm">

                <div class="card">
                    <article class="card-body">
                        <h4 class="card-title mb-4 mt-1">Sign in</h4>
                        <form>
                            <div class="form-group">
                                <label>Your username</label>
                                <input type="text" class="form-control" placeholder="Username" id="username">
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <a class="float-right" href="#">Forgot?</a>
                                <label>Your password</label>
                                <input type="password" class="form-control" placeholder="********" id="password">
                            </div> <!-- form-group// -->
                            <div class="form-group">
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block"> Login  </button>
                            </div> <!-- form-group// -->
                        </form>
                    </article>
                </div> <!-- card.// -->

            </div>
            <div class="col-sm">

                <div class="card">
                    <article class="card-body">
                        <h4 class="card-title mb-4 mt-1">Sign up</h4>
                        <form>
                            <div class="form-group">
                                <label>Your username</label>
                                <input type="text" class="form-control" placeholder="Username" id="username">
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <label>Your email</label>
                                <input type="text" class="form-control" placeholder="Email" id="email">
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <label>Your password</label>
                                <input type="password" class="form-control" placeholder="********" id="password">
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <label>Re Enter Your password</label>
                                <input type="password" class="form-control" placeholder="********" id="repassword">
                            </div> <!-- form-group// -->
                            <div class="form-group">
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block"> Login  </button>
                            </div> <!-- form-group// -->
                        </form>
                    </article>
                </div> <!-- card.// -->


            </div>
        </div>






    </div>
    </html>

<?php
include_once 'footer.php';
?>