<?php
    session_start();
    error_reporting(1);
    // Check if the user is already logged in, if yes then redirect him to welcome page
    require_once('config.php');
    $message = '';
    $email = $password = "";
    $email_err = $password_err = "";

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: home.php");
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Check if email is empty
        if(empty(trim($_POST["email"]))){
            echo "Please enter your email<br />";
        } else{
            $email= mysqli_real_escape_string($link,trim($_POST['email']));
        }

        // Check if password is empty
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = mysqli_real_escape_string($link,trim($_POST["password"])); 
        }
        if(empty($email_err) && empty($password_err)){
            // Prepare a select statement
            $sql = "SELECT user_name, email, password, role_id FROM users WHERE email = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                
                // Set parameters
                $param_email = $email;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Store result
                    mysqli_stmt_store_result($stmt);
                    
                    // Check if username exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1){                    
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt,$username, $email, $hashed_password,$role_id);

                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($password, $hashed_password)){
                                // Password is correct, so start a new session
                                session_start();
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;

                                if ($role_id==1) {
                                    $_SESSION["username"] = $username;                            
                                    $_SESSION['role_id'] = $role_id;
                                    header("location: ../index.php");
                                }else if($role_id == 2){
                                    $_SESSION["username"] = $username;
                                    $_SESSION['role_id'] = $role_id;
                                    header("location: ../Admin/category/index.php");
                                }
                                
                            } else{
                                // Display an error message if password is not valid
                                $message = "The password you entered was not valid.";
                                echo $message;
                            }
                        }
                    } else{
                        // Display an error message if username doesn't exist
                        $message = "No account found with that username.";
                        echo $message;
                    }
                } else{
                    $message = "Oops! Something went wrong. Please try again later.";
                    echo $message;
                }
             mysqli_stmt_close($stmt);
            }
            mysqli_close();   
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="images/service-1.png">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    
    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <div class="main">

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="./register.php" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="login-form" id="login-form" name="login-form" action="login.php">
                             
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your email" required="" />
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password" required="" />
                            </div>
                            <!-- <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div> -->
                            <div class="form-group form-button">
                                <input type="submit" name="btnLogin" id="signup" class="form-submit" value="login" />
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>