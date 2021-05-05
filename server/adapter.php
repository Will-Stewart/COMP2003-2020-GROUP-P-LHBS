<?php
# CONFIG


$servername = "proj-mysql.uopnet.plymouth.ac.uk";
$username = "COMP2003_P";
$password = "YleM560+";

/* Connect to MySQL */
$con = new mysqli($servername, $username, $password);
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}



# RESULT
$unavailable = array();
	$sql = "SELECT * FROM comp2003_p.hostelbookings WHERE `Booking_StartDate` > NOW()";
	if ($result = $con->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $unavailable[] = $row['date'];
        }
    } else {
        printf("Error: %s\n", $con->sqlstate);
        exit;
    }
echo implode(",",$unavailable);
	exit();
