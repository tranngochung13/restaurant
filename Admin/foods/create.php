<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$food_name = $prices = $description = $category_id = $status = "";
$food_name_err = $prices_err = $description_err = $category_id_err = $status_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    // Validate food name
    $input_food_name = trim($_POST["food_name"]);
    if(empty($input_food_name)){
        $food_name_err = "Please enter a name.";
    } else{
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
        // Prepare an insert statement
        $sql = "INSERT INTO foods (food_name, prices, description, category_id, status) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sisis", $param_food_name, $param_prices, $param_description, $param_cate_id, $param_status);
            
            // Set parameters
            $param_food_name = $food_name;
            $param_prices = $prices;
            $param_description = $description;
            $param_cate_id = $category_id;
            $param_status = $status;
            
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
                        <div class="form-group <?php echo (!empty($food_name_err)) ? 'has-error' : ''; ?>">
                            <label>Food Name</label>
                            <input type="text" name="food_name" class="form-control" value="<?php echo $food_name; ?>">
                            <span class="help-block"><?php echo $food_name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($prices_err)) ? 'has-error' : ''; ?>">
                            <label>Prices</label>
                            <textarea name="prices" class="form-control"><?php echo $prices; ?></textarea>
                            <span class="help-block"><?php echo $prices_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($description_err)) ? 'has-error' : ''; ?>">
                            <label>Description</label>
                            <textarea name="description" class="form-control"><?php echo $description; ?></textarea>
                            <span class="help-block"><?php echo $description_err;?></span>
                        </div>
                        <div class="form-group">
                            <label> Danh mục sản phẩm </label>
                            <select class="form-control" name="category_id">
                            <?php
                                $sql = "SELECT * FROM categories";
                                $result = mysqli_query($link,$sql);
                                if($result)
                                {
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                            ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['cate_name']; ?></option>   
                            <?php
                                    }
                                }
                           ?>
                            </select>
                        </div>
                        <div class="form-group <?php echo (!empty($status_err)) ? 'has-error' : ''; ?>">
                            <label>Status</label>
                            <input type="text" name="status" class="form-control" value="<?php echo $status; ?>">
                            <span class="help-block"><?php echo $status_err;?></span>
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