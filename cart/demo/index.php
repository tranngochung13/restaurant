<?php
/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com
*/
session_start();
include('db.php');
$status="";
if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result = mysqli_query($con,"SELECT * FROM foods, image, categories  WHERE `status`='$code'");
$row = mysqli_fetch_assoc($result);
$name = $row['food_name'];
$code = $row['status'];
$price = $row['prices'];
$image = $row['link'];

$cartArray = array(
	$code=>array(
	'name'=>$name,
	'code'=>$code,
	'price'=>$price,
	'quantity'=>1,
	'image'=>$image)
);

if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;
	$status = "<div class='box'>Product is added to your cart!</div>";
}else{
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($code,$array_keys)) {
		$status = "<div class='box' style='color:red;'>
		Product is already added to your cart!</div>";	
	} else {
	$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
	$status = "<div class='box'>Product is added to your cart!</div>";
	}

	}
}
?>
<html>
<head>
<title>Demo Simple Shopping Cart using PHP and MySQL - AllPHPTricks.com</title>
<link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
</head>
<body>
<div style="width:700px; margin:50 auto;">

<h2>Demo Simple Shopping Cart using PHP and MySQL</h2>   

<?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
<div class="cart_div">
<a href="cart.php"><img src="cart-icon.png" /> Cart<span><?php echo $cart_count; ?></span></a>
</div>
<?php
}
$duongdan = 'product-images/';
$result = mysqli_query($con,"SELECT * FROM foods, image, categories WHERE foods.id = image.food_id and categories.id = foods.category_id;");
while($row = mysqli_fetch_assoc($result)){
		echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='code' value=".$row['status']." />
			  <div class='image'><img style='height: 200px; width: 280px;' src='".$duongdan.$row['link']."' /></div>
			  <div class='name'>".$row['food_name']."</div>
		   	  <div class='price'>$".$row['prices']."</div>
			  <button type='submit' class='buy'>Buy Now</button>
			  </form>
		   	  </div>";

        }
mysqli_close($con);
?>


<!-- <div class='product_wrapper'>
		<form action="" method="POST" role="form">
		   	<input type='hidden' name='code' value=".$row['code']." />;
		   	<img style="height: 200px; width: 280px;" src="<?php echo $duongdan.$row['link'] ?>" alt="">
		   	<div class='name'><?php echo $row['food_name'] ?></div>
		   	<div class='price'><?php echo "$".$row['prices'] ?></div>
		   	<button type='submit' class='buy'>Buy Now</button>
		</form>
	</div> -->


<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>

<br /><br />
<a href="https://www.allphptricks.com/simple-shopping-cart-using-php-and-mysql/"><strong>Tutorial Link</strong></a> <br /><br />
For More Web Development Tutorials Visit: <a href="https://www.allphptricks.com/"><strong>AllPHPTricks.com</strong></a>
</div>
</body>
</html>