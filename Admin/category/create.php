<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$cate_name = $code = "";
$cate_name_err = $code_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
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
        // Prepare an insert statement
        $sql = "INSERT INTO categories (cate_name, code) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_cate_name, $param_code);
            
            // Set parameters
            $param_cate_name = $cate_name;
            $param_code = $code;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
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
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($cate_name_err)) ? 'has-error' : ''; ?>">
                            <label>Category Name</label>
                            <input type="text" name="cate_name" class="form-control" value="<?php echo $cate_name; ?>">
                            <span class="help-block"><?php echo $cate_name_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($code_err)) ? 'has-error' : ''; ?>">
                            <label>Code</label>
                            <input type="text"  name="code" class="form-control" value="<?php echo $code; ?>">
                            <span class="help-block"><?php echo $code_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>  

                  
        </div>
    </div>
</body>
</html>