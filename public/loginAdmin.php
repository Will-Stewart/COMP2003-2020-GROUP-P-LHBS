<?php

session_start();

include_once 'header.php';
require_once '../src/Model/dbConnect.php';

$servername = "proj-mysql.uopnet.plymouth.ac.uk";
$username = "COMP2003_P";
$password = "YleM560+";

// Create connection
$con = new mysqli($servername, $username, $password);

if(isset($_POST['adminName'])){

    $adminUsername=$_POST['adminName'];
    $adminPassword=$_POST['adminPass'];
    $adminCode=$_POST['loginNum'];

    $query="select * from comp2003_p.registeredadmins where Admin_Username='".$adminUsername."'AND Admin_Password='".$adminPassword."'AND LoginNum='".$adminCode."'limit 1";

    echo "<pre>Debug: $query</pre>\m";
    $result = mysqli_query($con, $query);

    if ( false===$result ) {
    printf("error: %s\n", mysqli_error($con));
    }
    elseif(mysqli_num_rows($result)==1){
        echo " You have successfully logged in";
        header("Location: adminPortal.php");
    exit();
    }
    else{
        echo "Incorrect password";
        exit();
    }
}

?>

<div class="container">
    <br>  <p class="text-center">This is where LHBS Admins should login, Users please go to the user log in page at: <a href="loginUser.php"> User Login</a></p>
    <hr>

    <div class="row">
        <aside class="col-sm-4">
            <div class="card">
                <article class="card-body">
                    <h4 class="card-title mb-4 mt-1">Admin- Sign in</h4>
                    <form method="POST" action="#">
                        <div class="form-group">
                            <label>Your Username</label>
                            <input type="text" class="form-control" placeholder="Username" name="adminName">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <a class="float-right" href="#">Forgot?</a>
                            <label>Your Password</label>
                            <input type="password" class="form-control" placeholder="********" name="adminPass">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <a class="float-right" href="#">Forgot?</a>
                            <label>Your Security Key</label>
                            <input type="text" class="form-control" placeholder="1234567" name="loginNum">
                        </div>
                        <div class="form-group">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="Login">
                        </div> <!-- form-group// -->
                    </form>
                </article>
            </div> <!-- card.// -->

        </aside> <!-- col.// -->
        <aside class="col-sm-4">

        </aside>
    </div>





</div>
</html>

<?php
include_once 'footer.php';
?>