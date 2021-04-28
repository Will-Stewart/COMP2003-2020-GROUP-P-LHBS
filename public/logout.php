<?php
include_once 'header.php';

session_start();
session_destroy();
// Redirect to the login page:
header('Location: index.php');
?>

<?php
include_once 'footer.php';
?>
