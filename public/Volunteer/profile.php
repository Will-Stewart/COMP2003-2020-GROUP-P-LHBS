<?php
session_start();
?>


<!--banner to be displayed at the top of the page-->
<div class="jumbotron text-center" style="margin-bottom:-30px; background-color: white">
    <div class="container">
        <h1 class="display-4">PROFILE PAGE</h1>
        <h1 class="lead">Welcome, <?php echo $_SESSION['name']?>! Here you can view your account details!</h1>
    </div>
</div>




<?php
include_once '../Headers/header.php';


// do check
if (!isset($_SESSION["loggedin"])) {
    header("location: error.php");
    exit; // prevent further execution, should there be more code that follows
}



// We need to use sessions, so you should always start sessions using the below code.
session_start();



// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}


$servername = "proj-mysql.uopnet.plymouth.ac.uk";
$username = "COMP2003_P";
$password = "YleM560+";

// Create connection
$con = new mysqli($servername, $username, $password);

    // We don't have the password or email info stored in sessions so instead we can get the results from the database.
    $stmt = $con->prepare('SELECT UPasswords, Email FROM comp2003_p.volunteer_accounts WHERE RegID = ?');
    // In this case we can use the account ID to get the account info.
    $stmt->bind_param('i', $_SESSION['RegIDs']);
    $stmt->execute();
    $stmt->bind_result($password, $email);
    $stmt->fetch();
    $stmt->close();
?>




<!--Display user details-->
<br>
    <div class="content">
        <div>
            <center>
            <p>YOUR ACCOUNT DETAILS:</p>
            <table>
                <tr>
                    <td>Username:</td>
                    <td><?=$_SESSION['name']?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><?=$email?></td>
                </tr>
            </table>
        </center>
        </div>
    </div>
<br>





<?php
include_once '../Headers/footer.php';
?>
