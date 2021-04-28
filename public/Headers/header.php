<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Llafan Hotel Booking System</title>
</head>

<body>
<?php
    if(isset($_SESSION['loggedin'])){
        include 'LoggedInHeader.php';
    }
    elseif (isset($_SESSION['adminLoggedin'])){
        include 'AdminLoginHeader.php';
    }
    else{
        include 'LoggedOutHeader.php';
    }
?>
</body>

