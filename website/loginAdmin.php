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
        <a class="navbar-brand mx-auto" href="#">Tallwyn Railway</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>





    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Right</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
        </ul>
    </div>
</nav>

<!--This is the admin login form-->

<div class="container">
    <h2>Admin Login</h2>
    <form>
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" placeholder="Username" id="">
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" placeholder="Password" id="">
        </div>
        <div class="mb-3">
            <label class="form-label">Security Key</label>
            <input type="text" class="form-control" id="">
        </div>
    </form>
</div>





</body>
</html>
