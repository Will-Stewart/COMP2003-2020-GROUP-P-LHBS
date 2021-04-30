<div class="jumbotron text-center" style="margin-bottom:-30px; background-color: white">
    <div class="container">
        <h1 class="display-4">VOLUNTEER LOGIN & SIGN UP</h1>
        <center><h3 class="lead">Login or Sign Up to create a booking and help support the Railway!</h3></center>
    </div>
</div>

<?php
include_once '../Headers/header.php';

$servername = "proj-mysql.uopnet.plymouth.ac.uk";
$username = "COMP2003_P";
$password = "YleM560+";

// Create connection
$con = new mysqli($servername, $username, $password);


if(isset($_POST['submitSignup']))
{
    //something was posted
    $usernameSignUp = $_POST['usernameSignup'];
    $passwordSignUp = $_POST['passwordSignup'];
    $emailSignUp = $_POST['emailSignup'];

    if(!empty($usernameSignUp) && !empty($passwordSignUp) && !empty($emailSignUp))
    {
        $hashedPassword = password_hash($passwordSignUp, PASSWORD_DEFAULT);

        //save to database
        $query = "insert into comp2003_p.registeredusers (Username,UPasswords,Email) values ('$usernameSignUp', '$hashedPassword', '$emailSignUp')";

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

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>PROFILE PAGE</title>
        <link href="../../assets/css/style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>

    <br>

    <!--This is the user login form-->
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card">
                    <article class="card-body">
                        <h4 class="card-title mb-4 mt-1">SIGN IN</h4>
                        <form action="../../src/Model/authentication.php" method="post">
                            <div>
                                <label>Username</label>
                                <input type="text" class="form-control" name="user_name">
                            </div>
                            <label></label>
                            <div>
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <label></label>
                            <div>
                                <input class="btn btn-primary" type="submit" name="submitSignIn" value="Submit">
                            </div>
                        </form>
                    </article>
                </div> <!-- card.// -->
            </div>
            <div class="col-sm">
                <div class="card">
                    <article class="card-body">
                        <form method="POST" action="#">
                            <h4 class="card-title mb-4 mt-1">SIGN UP</h4>
                            <div>
                                <label>Username</label>
                                <input type="text" class="form-control" name="usernameSignup">
                            </div>
                            <label></label>
                            <div>
                                <label>Email</label>
                                <input type="text" class="form-control" name="emailSignup">
                            </div>
                            <label></label>
                            <div>
                                <label>Password</label>
                                <input type="password" class="form-control" name="passwordSignup">
                            </div>
                            <label></label>
                            <div>
                                <input class="btn btn-primary" type="submit" name="submitSignup" value="Submit">
                            </div>
                        </form>
                    </article>
                </div> <!-- card.// -->

            </div>
        </div>
    </div>
    </html>

<br>


<?php
include_once '../Headers/footer.php';
?>