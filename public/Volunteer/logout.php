<?php
include_once '../Headers/header.php';

session_start();
session_destroy();


// Redirect to the login page:
header('Location: index.php');
?>

<?php
include_once '../Headers/footer.php';
?>
