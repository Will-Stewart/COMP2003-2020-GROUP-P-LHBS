<?php
include_once 'header.php';
include_once 'developmentNotice.php';
?>

<!--This is the admin login form-->

<div class="container" style="padding: 15px;">
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

<?php
include_once 'footer.php';
?>