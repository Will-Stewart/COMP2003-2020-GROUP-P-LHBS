<!DOCTYPE html>
<html lang="en">
<head>
    <title>Llafan Hotel Booking System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>


<body>


<nav class="navbar navbar-expand-md navbar-dark " style="background-color: #8B0808;">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav">
            <li class="nav-item">
                <img src="img/talyllyn-logo.png" width="228" height="66" alt="logo">
            </li>
        </ul>

        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="loginUser.php">User Login</a>
            </li>
            <li class="nav-item active" style="align-items: center">
                <a class="nav-link" href="loginAdmin.php">Admin Login</a>
            </li>
        </ul>
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
                    <h4 class="card-title mb-4 mt-1">Sign in</h4>
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





</body>
</html>
