<?php
session_start();
// Change this to your connection info.
$servername = "proj-mysql.uopnet.plymouth.ac.uk";
$username = "COMP2003_P";
$password = "YleM560+";

// Create connection
$con = new mysqli($servername, $username, $password);

$sql = "select * from comp2003_p.bookings where Confirmation = 'Unconfirmed' ";
$resultConfirmed = mysqli_query($con, $sql);




if ( mysqli_connect_errno() ) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());

}




// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['adminName'], $_POST['adminPass']) ) {
    // Could not get the data that should have been sent.
    exit('Please fill all the fields!');
}





// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT AdminID, Admin_Password FROM comp2003_p.admin_accounts WHERE Admin_Username = ?')) {

    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('s', $_POST['adminName']);
    $stmt->execute();

    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();
}




if ($stmt->num_rows > 0) {
    $stmt->bind_result($adminID, $adminPassword);
    $stmt->fetch();
    // Account exists, now we verify the password.

    // Note: remember to use password_hash in your registration file to store the hashed passwords.
    if (password_verify($_POST['adminPass'], $adminPassword)) {
        if ($resultConfirmed->num_rows > 0) {

            $message = "Notification: Unconfirmed Bookings Need to Be Managed!";
            echo "<script type='text/javascript'>alert('$message');</script>";

            session_regenerate_id();
                $_SESSION['adminLoggedin'] = TRUE;
                $_SESSION['nameAdmin'] = $_POST['adminName'];
                $_SESSION['AdminIDs'] = $adminID;
                header("refresh:1; url=../../public/Admin/adminPortal.php");
        }
        else
            {
                session_regenerate_id();
                $_SESSION['adminLoggedin'] = TRUE;
                $_SESSION['nameAdmin'] = $_POST['adminName'];
                $_SESSION['AdminIDs'] = $adminID;
                header("Location: ../../public/Admin/adminPortal.php");

            }
    }
    else
        {
            // Incorrect password
            echo 'Incorrect Username, Password';
        }
}
else
    {
        // Incorrect username
        echo 'Incorrect Username, Password';
    }
?>