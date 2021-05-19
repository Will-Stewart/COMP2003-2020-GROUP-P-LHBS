<?php
session_start();
?>


<!--Large Banner at the top of the page-->
<div class="jumbotron text-center" style="margin-bottom:-30px; background-color: white">
    <div class="container">
        <h1 class="display-4">PROFILE PAGE</h1>
        <h1 class="lead">Welcome, <?php echo $_SESSION['name']?>! Here you can view your account details!</h1>
    </div>
</div>



<?php
include_once '../Headers/header.php';


// do check admin login
if (!isset($_SESSION["adminLoggedin"])) {
    header("location: error.php");
    exit; // prevent further execution, should there be more code that follows
}


// We need to use sessions, so you should always start sessions using the below code.
session_start();



// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['adminLoggedin'])) {
    header('Location: index.php');
    exit;
}


//Store Database connection details
$servername = "proj-mysql.uopnet.plymouth.ac.uk";
$username = "COMP2003_P";
$password = "YleM560+";



// Create connection
$con = new mysqli($servername, $username, $password);

    // We don't have the password or email info stored in sessions so instead we can get the results from the database.
    $stmt = $con->prepare('SELECT Admin_Username, Admin_Password FROM comp2003_p.registeredadmins WHERE AdminID = ?');


    // In this case we can use the account ID to get the account info.
    $stmt->bind_param('i', $_SESSION['RegIDs']);
    $stmt->execute();
    $stmt->bind_result($password, $email);
    $stmt->fetch();
    $stmt->close();
?>



<!--Display account details-->
<br>
    <div class="content">
        <div>
            <center>
            <p>YOUR ACCOUNT DETAILS:</p>
            <table>
                <tr>
                    <td>Username:</td>
                    <td><?=$_SESSION['nameAdmin']?></td>
                </tr>
            </table>
        </center>
        </div>
    </div>
<br>



<?php
include_once '../Headers/footer.php';
?>
