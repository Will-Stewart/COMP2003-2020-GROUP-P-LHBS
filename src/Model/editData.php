<?php
session_start();
// Change this to your connection info.
$servername = "proj-mysql.uopnet.plymouth.ac.uk";
$username = "COMP2003_P";
$password = "YleM560+";

// Create connection
$con = new mysqli($servername, $username, $password);

if ( mysqli_connect_errno() ) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());

}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT * FROM comp2003_p.hostelbookings WHERE BookingID = ?')) {
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();

}

if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $password);
    $stmt->fetch();
    // Account exists, now we verify the password.
    // Note: remember to use password_hash in your registration file to store the hashed passwords.
    if ($_POST['password'] === $password) {
        // Verification success! User has logged-in!
        // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $_POST['user_name'];
        $_SESSION['RegIDs'] = $id;
        header("Location: ../../public/index.php");
    } else {
        // Incorrect password
        echo 'Incorrect username and/or password!';
    }
} else {
    // Incorrect username
    echo 'Incorrect username and/or password!';
}
?>
