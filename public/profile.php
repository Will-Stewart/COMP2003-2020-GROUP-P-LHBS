<?php
include_once 'header.php';

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
    $stmt = $con->prepare('SELECT UPasswords, Email FROM comp2003_p.registeredusers WHERE RegID = ?');
    // In this case we can use the account ID to get the account info.
    $stmt->bind_param('i', $_SESSION['RegIDs']);
    $stmt->execute();
    $stmt->bind_result($password, $email);
    $stmt->fetch();
    $stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PROFILE PAGE</title>
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
    <body class="loggedin">
        <div class="content">
            <h2>PROFILE PAGE</h2>
            <div>
                <p>Your account details are below:</p>
                <table>
                    <tr>
                        <td>Registration Identification:</td>
                        <td><?=$_SESSION['RegIDs']?></td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><?=$_SESSION['name']?></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><?=$email?></td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>

<?php
include_once 'footer.php';
?>
