<?php 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'restaurant');
$mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($mysqli,'utf8');
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
session_start();
if (isset($_SESSION['shopping_cart'])) {
// $giohang = $_SESSION['giohang'];
// foreach($giohang as $id =>$ls)
// {
// $row=mysqli_fetch_row(mysqli_query($mysqli,"SELECT * FROM products WHERE id in ('$id')"));
$sql = "INSERT INTO `orders` (user_id,order_date) values (?,CURDATE())";
mysqli_set_charset($mysqli, 'UTF8');

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
$sql2 = "INSERT INTO `orders_detail` values ($id,$id_order,$ls)";
if ($mysqli->query($sql2) === TRUE) {}
else { echo "".$mysqli>error;}
unset($_SESSION['shopping_cart']);}

}

?>