<!--banner to be displayed at the top of the page-->
<div class="jumbotron text-center" style="margin-bottom:-30px; background-color: white">
    <div class="container">
        <h1 class="display-4">VOLUNTEER LOGIN & SIGN UP</h1>
        <h3 class="lead">Login or Sign Up to create a booking and help support the Railway!</h3>
    </div>
</div>





<?php
include_once '../Headers/header.php';


//Store database connection details
$servername = "proj-mysql.uopnet.plymouth.ac.uk";
$username = "COMP2003_P";
$password = "YleM560+";

// Create connection
$con = new mysqli($servername, $username, $password);


if(isset($_POST['submitSignup']))
{
    //store signup details in variables
    $usernameSignUp = $_POST['usernameSignup'];
    $passwordSignUp = $_POST['passwordSignup'];
    $emailSignUp = $_POST['emailSignup'];


    //check if variables are not empty
    if(!empty($usernameSignUp) && !empty($passwordSignUp) && !empty($emailSignUp))
    {
        //hash user password
        $hashedPassword = password_hash($passwordSignUp, PASSWORD_DEFAULT);

        //save to database
        $query = "insert into comp2003_p.registeredusers (Username,UPasswords,Email) values ('$usernameSignUp', '$hashedPassword', '$emailSignUp')";

        $result = mysqli_query($con, $query);
        if ( false===$result ) {
            printf("error: %s\n", mysqli_error($con));
        }
        else {
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
                    <form action="../../src/Model/authentication.php" method="post" class="was-validated">


                        <!--Username form input-->
                        <div>
                            <label>Username</label>
                            <input type="text" class="form-control" name="user_name" required>
                            <div class="valid-feedback">
                                Username is looking good!
                            </div>
                            <div class="invalid-feedback">
                                Please insert your Username!
                            </div>
                        </div>



                        <label></label>


                        <!--Password form input-->
                        <div>
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required>
                            <div class="valid-feedback">
                                Password is looking good!
                            </div>
                            <div class="invalid-feedback">
                                Please insert your Password!
                            </div>
                        </div>



                        <label></label>


                        <!--Submit form button-->
                        <div>
                            <input class="btn btn-primary" type="submit" name="submitSignIn" value="Submit">
                        </div>
                    </form>
                </article>
            </div> <!-- card.// -->
        </div>





<!--Form for user signup-->
<div class="col-sm">
    <div class="card">
        <article class="card-body">
            <form method="POST" action="#" class="was-validated">



                <!--Username form input-->
                <h4 class="card-title mb-4 mt-1">SIGN UP</h4>
                <div>
                    <label>Username</label>
                    <input type="text" class="form-control" name="usernameSignup" minlength="8" required>
                    <div class="valid-feedback">
                        Username is looking good!
                    </div>
                    <div class="invalid-feedback">
                        Please Choose a Suitable Username - 8 Characters Minimum!
                    </div>
                </div>



                <label></label>



                <!--Email form input-->
                <div>
                    <label>Email</label>
                    <input type="email" class="form-control" name="emailSignup" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please Insert a Suitable Email!
                    </div>
                </div>



                <label></label>


                <!--Password form input-->
                <div>
                    <label>Password</label>
                    <input type="password" class="form-control" name="passwordSignup" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{12,}" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        "Must contain at least one  number and one uppercase and lowercase letter, and at least 12 or more characters"
                    </div>
                </div>



                <label></label>


                <!--Submit button-->
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