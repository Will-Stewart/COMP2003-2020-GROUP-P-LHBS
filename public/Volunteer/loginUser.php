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
    $emailSignUp = $_POST['emailSignup'];

//    $password=$_POST['passwordSignup'];
//    $options = array(
//        'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
//        'cost' => 12,
//    );
//    $hashedpass = password_hash($password, PASSWORD_BCRYPT, $options);

    if(!empty($usernameSignUp) && !empty($passwordSignUp) && !empty($emailSignUp))
    {
        //save to database
        $query = "insert into comp2003_p.registeredusers (Username,UPasswords,Email) values ('$usernameSignUp','$hashedpass','$emailSignUp')";

        echo "<pre>Debug: $query</pre>\m";
        $result = mysqli_query($con, $query);
        if ( false===$result ) {
            printf("error: %s\n", mysqli_error($con));
        }
        else {
            echo 'done.';
            header("Location: ../public/index.php");
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

    <!--This is the user login form-->
    <body class="loggedin">
    <div class="content">
        <h2>Log In & Sign Up</h2>
        <div class="row">
            <div class="col-sm">
                <div class="card">
                    <article class="card-body">
                        <h4 class="card-title mb-4 mt-1">Sign In</h4>
                        <form action="../../src/Model/authentication.php" method="post">
                            <div>
                                <label>Username</label>
                                <input type="text" class="form-control" name="user_name">
                            </div>
                            <label></label>
                            <div>
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                                <a class="float-right" href="#">Forgot?</a>
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
                        <h4 class="card-title mb-4 mt-1">Sign Up</h4>
                        <form method="POST" action="#">
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

    </body>
    </html>

<?php
include_once '../Headers/footer.php';
?>