<div class="jumbotron text-center" style="margin-bottom:-30px; background-color: white">
    <div class="container">
        <h1 class="display-4">ADMIN USER MANAGER</h1>
        <h3 class="lead">The Admin User Manager can provide details on Admins and allow you to add new Accounts!</h3>
    </div>
</div>

<?php
include_once '../Headers/header.php';

// do check
if (!isset($_SESSION["adminLoggedin"])) {
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

    if(!empty($usernameSignUp) && !empty($passwordSignUp))
    {
        $hashedPassword = password_hash($passwordSignUp, PASSWORD_DEFAULT);

        //save to database
        $query = "insert into comp2003_p.registeredadmins (Admin_Username,Admin_Password) values ('$usernameSignUp','$hashedPassword')";

        $result = mysqli_query($con, $query);
        if ( false===$result ) {
            printf("error: %s\n", mysqli_error($con));
        }else{
            header("Location: adminUserManager.php");
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

<br>

<div class="container">
    <div class="content">
    <div class="row">
        <div class="col-sm">
        <h3 class="card-title mb-4 mt-1">Enter Admin Details</h3>
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



<br>

<!DOCTYPE html>
<html>
<head>
    <style>
        table{
            border-collapse: collapse;
            width: 100%;
            color: #d96459;
            font-family: sans-serif;
            font-size: 16px;
            text-align: left;
        }
        th{
            background-color: #2f3947;
            color: white;
        }
    </style>

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
</head>
</html>
</div>

<br>

<?php
include_once '../Headers/footer.php';
?>