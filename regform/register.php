<?php  
    session_start();
    error_reporting(1);
    require_once('config.php');
    $username = $phone = $email = $password = $confirm_password = $role_id = '';
    $username_err = $phone_err = $email_err = $password_err = $confirm_password_err = ''; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    	if (empty(trim($_POST['username']))) {
			$username_err = 'Please enter the username';
    	}
    	else{
			// Prepare a select statement
        	$sql = "SELECT id FROM users WHERE user_name = ?";

        	if ($stmt = mysqli_prepare($link,$sql)) {
        		// Bind variables to the prepared statement as parameters
	            mysqli_stmt_bind_param($stmt, "s", $param_username);

	            // Set parameters
	            $param_username = trim($_POST["username"]);

	            // Attempt to execute the prepared statement
	            if(mysqli_stmt_execute($stmt)){
	                
	                mysqli_stmt_store_result($stmt);
	                
	                if(mysqli_stmt_num_rows($stmt) == 1){
	                    $username_err = "This username is already taken.";
	                } else{
	                    $username = trim($_POST["username"]);
	                }
	            } else{
	                echo "Oops! Something went wrong. Please try again later.";
	            }
	        }
	        // Close statement
       	 	mysqli_stmt_close($stmt);	
    	}
        // Validate password
        if(empty(trim($_POST["phone"]))){
            $password_err = "Please enter a phone.";     
        } else if(strlen(trim($_POST["phone"])) != 10){
            $password_err = "The length of phone must be 10 number.";
        } else{
            $password = trim($_POST["phone"]);
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
          } else {
            $email = $_POST["email"];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $emailErr = "Invalid email format"; 
            }
          }

    	// Validate password
	    if(empty(trim($_POST["password"]))){
	        $password_err = "Please enter a password.";     
	    } else if(strlen(trim($_POST["password"])) < 8){
	        $password_err = "Password must have atleast 8 characters.";
	    } else{
	        $password = trim($_POST["password"]);
	    }

	    // Validate confirm password
	    if(empty(trim($_POST["confirm_password"]))){
	        $confirm_password_err = "Please confirm password.";     
	    } else{
	        $confirm_password = trim($_POST["confirm_password"]);
	        if(empty($password_err) && ($password != $confirm_password)){
	            $confirm_password_err = "Password did not match.";
	        }
	    }

	    if (empty($username_err) && empty($phone_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
	    	// Prepare an insert statement
        	$sql = "INSERT INTO users (user_name,phone,email,password,role_id) VALUES (?, ?, ?, ?,?)";  
            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt,'sissi',$username,$phone,$email,$password,$role_id);
                $username = mysqli_real_escape_string($link,$_REQUEST['username']);
                $phone = mysqli_real_escape_string($link,$_REQUEST['phone']); 
                $email = mysqli_real_escape_string($link,$_REQUEST['email']);
                $password = password_hash(mysqli_real_escape_string($link,$_REQUEST['password']), PASSWORD_DEFAULT);
                $role_id = 1;
                $_SESSION['username'] = $username;
                $_SESSION['message'] = 'Hello '.$_SESSION['username'];
                if(mysqli_stmt_execute($stmt)){
                    header("location: login.php");
                } else{
                    echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
                }
            }
            mysqli_close($link);    
        }   
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/service-1.png">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form" action="register.php" name="register-form">

                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="name" placeholder="Your Name" required="" />
                            </div>
                            <div class="form-group">
                                <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                                <input type="text" name="phone" id="phone" placeholder="Your Phone" required="" />
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="You can use email for user" required="" />
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="pass" placeholder="Password" required="" />
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="confirm_password" min="10" id="re_pass" placeholder="Repeat your password" required="" />
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="btnRegister" id="signup" class="form-submit"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="./login.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

    </div>
    
    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>