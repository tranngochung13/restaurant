<?php
require_once "config.php";
// Include config file
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
//     // Prepare a select statement
    $sql = "SELECT image.id,foods.food_name,image.link FROM foods,image where foods.id = image.food_id and  image.id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
//         // Set parameters   
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
//                  Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop 
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                // Retrieve individual field value
                $food_name = $row["food_name"];
                $image = $row["link"];
            } else{
//                 // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    // Close statement
    mysqli_stmt_close($stmt);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $msg = "";
        $target_file = "./image/".basename($_FILES["FileImage"]["name"]);
        $image = $_FILES["FileImage"]["name"]; 
        // Get hidden input value
        $id = $_GET["id"];
        // Prepare an update statement
        $sql = "UPDATE image SET link=? WHERE id=?";
             
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_image, $param_id);
                // Set parameters
                $param_image = $image;
                $param_id = $id;
                
            if (move_uploaded_file($_FILES['FileImage']['tmp_name'],$target_file)) {
                $msg = 'successfully';
            }
            else{
                $msg = 'lost';
            }
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }      
            // Close statement
            mysqli_stmt_close($stmt);    
        }
    }
} 
// else{
//     // URL doesn't contain id parameter. Redirect to error page
//     header("location: error.php");
//     exit();
// }
// Processing form data when form is submitted
 
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
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" enctype="multipart/form-data">          
                        <div class="form-group">
                            <label>Food Name</label>
                            <p class="form-control-static"><?php echo $food_name; ?></p>
                        </div>
                        <div class="form-group">
                        <label>Old image</label><br>
                            <img src='<?php echo "image/$image" ?>' alt="placeholder+image">
                        </div>
                        <div class="form-group">
                            <label>Tải ảnh lên </label>
                            <input type="File" name="FileImage" class="form-control" required>
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