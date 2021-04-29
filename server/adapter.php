<?php
# CONFIG

define('_DB_HOST', 'localhost');
define('_DB_NAME', 'demo');
define('_DB_USER', 'user');
define('_DB_PASS', 'pass');
/* Connect to MySQL */
$mysqli = new mysqli(_DB_HOST, _DB_USER, _DB_PASS,_DB_NAME);
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}



# RESULT
$unavailable = array();
	$sql = "SELECT * FROM free_availability_calendar WHERE `date` > NOW()";
	if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $unavailable[] = $row['date'];
        }
    } else {
        printf("Error: %s\n", $mysqli->sqlstate);
        exit;
    }
echo implode(",",$unavailable);
	exit();
