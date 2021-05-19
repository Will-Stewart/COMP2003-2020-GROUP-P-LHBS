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





// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['user_name'], $_POST['password']) ) {
    // Could not get the data that should have been sent.
    exit('Please fill both the username and password fields!');
}





// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT RegID, UPasswords FROM comp2003_p.volunteer_accounts WHERE Username = ?')) {
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('s', $_POST['user_name']);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();

}





if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $password);
    $stmt->fetch();

    // Account exists, now we verify the password.
    // Note: remember to use password_hash in your registration file to store the hashed passwords.
    if (password_verify($_POST['password'], $password)) {
      // Verification success! User has logged-in!
        // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $_POST['user_name'];
        $_SESSION['RegIDs'] = $id;

        $sql = "select * from comp2003_p.bookings where Confirmation = 'Confirmed' AND RegID = $id";
        $resultConfirmed = mysqli_query($con, $sql);

        if ($resultConfirmed->num_rows > 0) {
            $message = "Notification: You have confirmed bookings!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            header("refresh:1; url=../../public/Volunteer/index.php");
        }
        else
            {
            header("refresh:1; url=../../public/Volunteer/index.php");
            }
    }
    else
        {
        // Incorrect username
        echo 'Incorrect username and/or password!';
        header("refresh:2; url=../../public/Volunteer/loginUser.php");
        }
}
?>


