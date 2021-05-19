<!--Large Banner at the top of the page-->
<div class="jumbotron text-center" style="margin-bottom:-30px; background-color: white">
    <div class="container">
        <h1 class="display-4">ADMIN USER MANAGER</h1>
        <h3 class="lead">The Admin User Manager can provide details on Admins and allow you to add new Accounts!</h3>
    </div>
</div>




<?php
include_once '../Headers/header.php';


// do check admin login
if (!isset($_SESSION["adminLoggedin"])) {
    header("location: error.php");
    exit; // prevent further execution, should there be more code that follows
}


    //Store database connection details
    $servername = "proj-mysql.uopnet.plymouth.ac.uk";
    $username = "COMP2003_P";
    $password = "YleM560+";

    // Create connection
    $con = new mysqli($servername, $username, $password);

    //Query to retrieve admin details
    $sql = "select Admin_Username, Admin_Password from comp2003_p.registeredadmins";
    $result = mysqli_query($con, $sql);


//If the warden clicks submit, submit username, hash password and submit password
if(isset($_POST['submitSignup']))
{
    //something was posted
    $usernameSignUp = $_POST['adminUsername'];
    $passwordSignUp = $_POST['adminPassword'];
    $reenterPasswordSignUp = $_POST['reenterPassword'];

    if(!empty($usernameSignUp) && !empty($passwordSignUp))
    {
        if($reenterPasswordSignUp == $passwordSignUp){

            //Hash password
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
    }else
    {
        echo "Please enter some valid information!";
    }
}
?>




<br>



<!--Form to retrieve admin account details-->
<div class="container">
    <div class="content">
        <div class="row">
            <div class="col-sm">
            <h3 class="card-title mb-4 mt-1">Enter Admin Details</h3>
                <form method="POST" action="#" class="was-validated">


                    <div>
                        <label>Username</label>
                        <input type="text" class="form-control" name="adminUsername" minlength="12" required>
                        <div class="valid-feedback">
                            Username is looking good!
                        </div>
                        <div class="invalid-feedback">
                            Please Choose a Suitable Username - 12 Characters Minimum!
                        </div>
                    </div>


                    <label></label>


                    <div>
                        <label>Password</label>
                        <input type="password" class="form-control" name="adminPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{12,}" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            "Must contain at least one  number and one uppercase and lowercase letter, and at least 12 or more characters"
                        </div>
                    </div>


                    <label></label>


                    <!--Password form input-->
                    <div>
                        <label>Re-Enter Password</label>
                        <input type="password" class="form-control" name="reenterPassword" required>
                        <div class="valid-feedback">
                            Password is looking good!
                        </div>
                        <div class="invalid-feedback">
                            Please re-enter your password
                        </div>
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




<!--Table to display admin accounts-->
                <h3>Admin Users</h3>
                <div class="list-group">
                    <table class="table table-hover" id="adminUsers">
                        <thead>
                        <tr class="table-confirm">
                            <th scope="col">Admin Username</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($result-> num_rows > 0){
                            while($row = $result-> fetch_assoc()){
                                echo "<tr class='table-row'>
                                           <td>". $row["Admin_Username"] ."</td>
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
</div>


</head>
</html>


<br>



<?php
include_once '../Headers/footer.php';
?>