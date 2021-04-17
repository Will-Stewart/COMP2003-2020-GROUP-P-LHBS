<?php

session_start();

include_once 'header.php';
include("../src/model/functions.php");

$servername = "proj-mysql.uopnet.plymouth.ac.uk";
$username = "COMP2003_P";
$password = "YleM560+";

// Create connection
$con = new mysqli($servername, $username, $password);

if(isset($_POST['user_name'])){

    $uname=$_POST['user_name'];
    $upassword=$_POST['password'];

    $query="select * from comp2003_p.registeredusers where Username='".$uname."'AND UPasswords='".$upassword."'limit 1";

    echo "<pre>Debug: $query</pre>\m";
    $result = mysqli_query($con, $query);
    if ( false===$result ) {
        printf("error: %s\n", mysqli_error($con));
    }
    elseif(mysqli_num_rows($result)==1){
        echo " You have successfully logged in";
        header("Location: index.php");
        exit();
    }
    else{
        echo "Incorrect password";
        exit();
    }
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //something was posted
    $usernameSignUp = $_POST['usernameSignup'];
    $emailSignUp = $_POST['emailSignup'];
    $passwordSignUp = $_POST['passwordSignup'];

    if(!empty($usernameSignUp) && !empty($passwordSignUp) && !empty($emailSignUp))
    {

        //save to database
        $query = "insert into comp2003_p.registeredusers (Username,UPasswords,Email) values ('$usernameSignUp','$passwordSignUp','$emailSignUp')";

        echo "<pre>Debug: $query</pre>\m";
        $result = mysqli_query($con, $query);
        if ( false===$result ) {
            printf("error: %s\n", mysqli_error($con));
        }
        else {
            echo 'done.';
            header("Location: index.php");
        }
    }else
    {
        echo "Please enter some valid information!";
    }
}

?>

    <!--This is the user login form-->
    <div class="container">
        <br>  <p class="text-center">This is where LHBS users should login, Admins please go to the admin log in page at: <a href="loginAdmin.php"> Admin Login</a></p>
        <hr>


        <div class="row">
            <div class="col-sm">

                <div class="card">
                    <article class="card-body">
                        <h4 class="card-title mb-4 mt-1">Sign in</h4>
                        <form method="POST" action="#">
                            <div>
                                <label>Username</label>
                                <input type="text" class="form-control" name="user_name">
                            </div>

                            <div>
                                <a class="float-right" href="#">Forgot?</a>
                                <label>Password</label>
                                <input id="password" class="form-control" name="password">
                            </div>

                            <div style="padding-top: 5px;">
                                <input class="btn btn-primary" type="submit" value="Confirm">
                            </div>
                        </form>
                    </article>
                </div> <!-- card.// -->

            </div>
            <div class="col-sm">

                <div class="card">
                    <article class="card-body">
                        <h4 class="card-title mb-4 mt-1">Sign up</h4>
                        <form method="POST" action="#">
                            <div>
                                <label>Username</label>
                                <input type="text" class="form-control" name="usernameSignup">
                            </div>

                            <div>
                                <a class="float-right" href="#">Forgot?</a>
                                <label>Email</label>
                                <input type="password" class="form-control" name="emailSignup">
                            </div>

                            <div>
                                <a class="float-right" href="#">Forgot?</a>
                                <label>Password</label>
                                <input type="text" class="form-control" name="passwordSignup">
                            </div>

                            <div style="padding-top: 5px;">
                                <input class="btn btn-primary" type="submit" value="Confirm">
                            </div>
                        </form>
                    </article>
                </div> <!-- card.// -->

            </div>
        </div>
    </div>
    </html>

<?php
include_once 'footer.php';
?>