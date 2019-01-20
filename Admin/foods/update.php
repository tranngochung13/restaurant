<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$food_name = $prices = $description = $category_id = $status = "";
$food_name_err = $prices_err = $description_err = $category_id_err = $status_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate food name
    $input_food_name = trim($_POST["food_name"]);
    if(empty($input_food_name)){
        $food_name_err = "Please enter a name.";
    }else{
        $food_name = $input_food_name;
    }
    
    // Validate prices
    $input_food_prices = trim($_POST["prices"]);
    if(empty($input_food_prices)){
        $prices_err = "Please enter the prices amount.";     
    } elseif(!ctype_digit($input_food_prices)){
        $prices_err = "Please enter a positive integer value.";
    } else{
        $prices = $input_food_prices;
    }

    // Validate description
    $input_food_description = trim($_POST["description"]);
    if(empty($input_food_description)){
        $description_err = "Please enter an prices.";     
    } else{
        $description = $input_food_description;
    }
    
    // Validate category id
    $input_food_category_id = trim($_POST["category_id"]);
    if(empty($input_food_prices)){
        $category_id_err = "Please enter the prices amount.";     
    } elseif(!ctype_digit($input_food_category_id)){
        $category_id_err = "Please enter a positive integer value.";
    } else{
        $category_id = $input_food_category_id;
    }

    // Validate status
    $input_food_status = trim($_POST["status"]);
    if(empty($input_food_status)){
        $status_err = "Please enter an prices.";     
    } else{
        $status = $input_food_status;
    }
    
    // Check input errors before inserting in database
    if(empty($food_name_err) && empty($prices_err) && empty($description_err)
     && empty($category_id_err) && empty($status_err)){
        // Prepare an update statement
        $sql = "UPDATE foods SET food_name=?, prices=?, description=?, category_id=?, status=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sisisi", $param_food_name, $param_prices, $param_description, $param_cate_id, $param_status, $param_id);
            
            // Set parameters
            $param_food_name = $food_name;
            $param_prices = $prices;
            $param_description = $description;
            $param_cate_id = $category_id;
            $param_status = $status;
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
        $sql = "SELECT * FROM foods WHERE id = ?";
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
                    $food_name = $row["food_name"];
                    $prices = $row["prices"];
                    $description = $row["description"];
                    $category_id = $row["category_id"];
                    $status = $row["status"];
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
                        <div class="form-group <?php echo (!empty($food_name_err)) ? 'has-error' : ''; ?>">
                            <label>Food Name</label>
                            <input type="text" name="food_name" class="form-control" value="<?php echo $food_name; ?>">
                            <span class="help-block"><?php echo $food_name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($prices_err)) ? 'has-error' : ''; ?>">
                            <label>Prices</label>
                            <input name="prices" class="form-control" value="<?php echo $prices; ?>">
                            <span class="help-block"><?php echo $prices_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($description_err)) ? 'has-error' : ''; ?>">
                            <label>Description</label>
                            <textarea name="description" class="form-control"><?php echo $description; ?></textarea>
                            <span class="help-block"><?php echo $description_err;?></span>
                        </div>
                        <div class="form-group">
                            <label> Category id </label>
                            <select class="form-control" name="category_id">
                                <?php
                                    require('config.php');
                                    $res_cate_id = mysqli_query($link,"SELECT * FROM categories WHERE id = ". $row['category_id']);
                                    while($rowCa = mysqli_fetch_assoc($res_cate_id))
                                    {
                                ?>
                                        <option value="<?php echo $rowCa['id']; ?>"><?php echo $rowCa['cate_name']; ?></option>   
                                
                                <?php
                                    }
                                
                                    $sqlCate = "SELECT * FROM categories";
                                    $resCate = mysqli_query($link,$sqlCate);
                                   
                                    while($rowCate = mysqli_fetch_assoc($resCate))
                                    {
                                        if ($rowCate['id'] != $row['category_id']) {
                                        # code...
                                    
                                ?>
                                        <option value="<?php echo $rowCate['id']; ?>"><?php echo $rowCate['cate_name']; ?></option>   
                                
                                <?php
                                        }   
                                    }
                                    mysqli_close($link);
                               ?>
                                
                            </select>
                            <span class="help-block"><?php echo $status_err;?></span>

                        </div>
                        <div class="form-group <?php echo (!empty($status_err)) ? 'has-error' : ''; ?>">
                            <label>Status</label>
                            <input type="text" name="status" class="form-control" value="<?php echo $status; ?>">
                            <span class="help-block"><?php echo $status_err;?></span>
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