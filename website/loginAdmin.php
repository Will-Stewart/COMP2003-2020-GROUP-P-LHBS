<!DOCTYPE html>
<html lang="en">
<head>
    <title>Llafan Hotel Booking System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>


<body>


<div class="jumbotron text-center" style="margin-bottom:0">
    <h1 style="font-family:Tahoma;white-space: nowrap; font-size: 40px;">Llafan Hotel Booking System</h1>
</div>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">LHBS</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li style="font-family: Calibri"><a href="index.php">Home</a></li>
                <li class="active" style="font-family: Calibri"><a href="#">Admin Login</a></li>
                <li style="font-family: Calibri"><a href="loginUser.php">User Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h2>Login</h2>
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
