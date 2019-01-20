<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $phone = $email = $password = "";
$username_err = $phone_err = $email_err = $password_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate cate name
    $input_cate_name = trim($_POST["cate_name"]);
    if(empty($input_cate_name)){
        $cate_cate_err = "Please enter a name.";
    }else{
        $cate_name = $input_cate_name;
    }
    
    // Validate name
    $input_cate_code = trim($_POST["code"]);
    if(empty($input_cate_code)){
        $code_err = "Please enter a code.";
    }else if(!filter_var($input_cate_code, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $code_err = "Please enter a valid name.";
    }
    else{
        $code = $input_cate_code;
    }

    // Check input errors before inserting in database
    if(empty($cate_cate_err) && empty($code_err)){
        // Prepare an update statement
        $sql = "UPDATE categories SET cate_name=?, code=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssi", $param_cate_name, $param_code, $param_id);
            
            // Set parameters
            $param_cate_name = $cate_name;
            $param_code = $code;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM categories WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $cate_name = $row["cate_name"];
                    $code = $row["code"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($cate_name_err)) ? 'has-error' : ''; ?>">
                            <label>Category</label>
                            <input type="text" name="cate_name" class="form-control" value="<?php echo $cate_name; ?>">
                            <span class="help-block"><?php echo $cate_name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($code_err)) ? 'has-error' : ''; ?>">
                            <label>Code</label>
                            <input name="code" class="form-control" value="<?php echo $code; ?>">
                            <span class="help-block"><?php echo $code_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>