<?php
// Include config file
require_once "config.php";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $msg = "";
    $target_file = "./image/".basename($_FILES["FileImage"]["name"]);
    $image = $_FILES["FileImage"]["name"];   

    // Check input errors before inserting in database
        $sql = "INSERT INTO image (food_id, link) VALUES (?, ?)";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "is", $param_food_id, $param_image);
            
            // Set parameters
            $param_food_id = $_POST['food_id'];
            $param_image = $image;

            if (move_uploaded_file($_FILES['FileImage']['tmp_name'],$target_file)) {
                $msg = 'successfully';
            }
            else{
                $msg = 'lost';
            }
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
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label> Danh mục thức ăn </label>
                            <select class="form-control" name="food_id">
                            <?php
                                $sql = "SELECT * FROM foods";
                                $result = mysqli_query($link,$sql);
                                if($result)
                                {
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                            ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['food_name']; ?></option>   
                            <?php
                                    }
                                }
                           ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tải ảnh lên </label>
                            <input type="File" name="FileImage" class="form-control" required>
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