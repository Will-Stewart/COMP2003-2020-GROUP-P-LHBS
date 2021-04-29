<?php
include_once '../Headers/header.php';

// do check
if (!isset($_SESSION["AdminIDs"])) {
    header("location: error.php");
    exit; // prevent further execution, should there be more code that follows
}

$servername = "proj-mysql.uopnet.plymouth.ac.uk";
$username = "COMP2003_P";
$password = "YleM560+";

// Create connection
$con = new mysqli($servername, $username, $password);


if(isset($_POST['submitSignup']))
{
    //something was posted
    $usernameSignUp = $_POST['adminUsername'];
    $passwordSignUp = $_POST['adminPassword'];

    if(!empty($usernameSignUp) && !empty($passwordSignUp) && !empty($emailSignUp))
    {
        //save to database
        $query = "insert into comp2003_p.registeredadmins (Admin_Username,Admin_Password) values ('$usernameSignUp','$passwordSignUp')";

        echo "<pre>Debug: $query</pre>\m";
        $result = mysqli_query($con, $query);

        if ( false===$result ) {
            printf("error: %s\n", mysqli_error($con));
        }
    }
    else
    {
        echo "Please enter some valid information!";
    }
}

$sql = "select Admin_Username, Admin_Password from comp2003_p.registeredadmins";
$result = mysqli_query($con, $sql);

?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>PROFILE PAGE</title>
        <link href="../../assets/css/style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>

<!--This is the user login form-->
<body class="loggedin">
    <div class="content">
        <h2>CREATE NEW ADMIN USER</h2>
        <div class="col-sm">
            <div class="card">
                <article class="card-body">
                    <h4 class="card-title mb-4 mt-1">Enter Admin Details</h4>
                    <form method="POST" action="#">
                        <div>
                            <label>Username</label>
                            <input type="text" class="form-control" name="adminUsername">
                        </div>
                        <label></label>
                        <div>
                            <label>Password</label>
                            <input type="password" class="form-control" name="adminPassword">
                        </div>
                        <label></label>
                        <div>
                            <input class="btn btn-primary" type="submit" name="submitSignup" value="Submit">
                        </div>
                    </form>
                </article>
            </div> <!-- card.// -->
        </div>
    </body>
</html>

<div class="container">
    <div class="row">
        <div class="col-sm">
            <h3>Admin Users</h3>
            <div class="list-group">
                <table class="table table-hover" id="adminUsers">
                    <thead>
                    <tr class="table-confirm">
                        <th scope="col">Admin Username</th>
                        <th scope="col">Password</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($result-> num_rows > 0){
                        while($row = $result-> fetch_assoc()){
                            echo "<tr name='table-row'>
                                       <td>". $row["Admin_Username"] ."</td>
                                       <td>". $row["Admin_Password"] ."</td>
                                       </tr>";
                        }
                        echo "</table>";
                    }
                    else{
                        echo $result + "results";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include_once '../Headers/footer.php';
?>