<?php 
    error_reporting(1); 
    session_start();
    require_once('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">

    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">
        <h1>Home</h1>
        <div> 
            <?php 
                if ($_SESSION['role_id'] == 1) {
                    echo "<h4>"."Đây là user có username là ".$_SESSION['username']."</h4>" ;
                } else if ($_SESSION['role_id'] == 2) {
                    echo "<h4>"."Đây là admin có username là ".$_SESSION['username']."</h4>";
                }
            ?>
            <p><a href="logout.php" class="btn btn-primary">Log out</a></p>
        </div>
    </div>
    
    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>