<?php 
include("connect.php");
session_start();
if (isset($_SESSION['shopping_cart'])) {

<<<<<<< Updated upstream
  $id = $_SESSION['id'];
  mysqli_set_charset($mysqli, 'UTF8');
  echo $id;
  $sql = "INSERT INTO `orders` (user_id,order_date) values (?,?)";
  if($stmt = mysqli_prepare($mysqli, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "is", $param_cate_name, $param_code);
    
    // Set parameters
    $param_cate_name = $id;
    $param_code = "date('Y-m-d')";
    
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        // Records created successfully. Redirect to landing page
        echo "successfully";
        exit();
    } else{
        echo "Something went wrong. Please try again later.";
    }
  }
=======
if($stmt = $mysqli->prepare($sql)){
   // Bind variables to the prepared statement as parameters
   $stmt->bind_param("s", $_SESSION['id']);
   $time = "CURDATE()";
    $stmt->execute();
    echo "
   <div class='alert alert-success'>
       <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
       <b>
           <a href='index.php'>
               <b style='color:red'>[WEBSITE TELEPHONE:]</b>
           </a> Thanh toán thành công. Hẹn gặp lại bạn!
       </b>
   </div><script>alert('[WEBSITE TELEPHONE:] Thanh toán thành công. Hẹn gặp lại bạn!')</script>
   ";
    // header('location: index.php');
    // unset($_SESSION['id']);
    // unset($_SESSION['giohang']);
}
$id_order=0;
   $sql1= "SELECT * from orders where user_id = ".$_SESSION['id']." and order_date = CURDATE()" ;
   $result = $mysqli->query($sql1);
if($result){
while($row1 = $result->fetch_array(MYSQLI_ASSOC)){
    echo $id_order;
$id_order = $row1['id'];
}
}
$giohang = $_SESSION['shopping_cart'];
foreach($giohang as $id =>$ls)
{
$row=mysqli_fetch_row(mysqli_query($mysqli,"SELECT * FROM products WHERE id in ('$id')"));
// echo $ls;
$sql2 = "INSERT INTO `orders_detail` values ($id,$id_order)";
if ($mysqli->query($sql2) === TRUE) {}
else { echo "".$mysqli>error;}
unset($_SESSION['shopping_cart']);
}
>>>>>>> Stashed changes


        // Prepare an insert statement
    // $sql = "INSERT INTO `orders` (user_id,order_date) values (?,?)";

    // if($stmt = mysqli_prepare($mysqli, $sql)){
    //         // Bind variables to the prepared statement as parameters
    //   mysqli_stmt_bind_param($stmt, "is", $param_id, $param_time);

    //         // Set parameters
    //   $param_id = $id;
    //   $param_time = "date('Y-m-d')";

    //         // Attempt to execute the prepared statement
    //   if(mysqli_stmt_execute($stmt)){
    //             // Records created successfully. Redirect to landing page
    //     echo "
    //     <div class='alert alert-success'>
    //     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    //     <b>
    //     <a href='index.php'>
    //     <b style='color:red'>[WEBSITE TELEPHONE:]</b>
    //     </a> Thanh toán thành công. Hẹn gặp lại bạn!
    //     </b>
    //     </div><script>alert('[WEBSITE TELEPHONE:] Thanh toán thành công. Hẹn gặp lại bạn!')</script>
    //     ";
    //     exit();
    //   } else{
    //     echo "Something went wrong. Please try again later.";
    //   }
    // }else{
    //   echo "nothing";
    // }

        // Close statement
    mysqli_stmt_close($stmt);
}
?>