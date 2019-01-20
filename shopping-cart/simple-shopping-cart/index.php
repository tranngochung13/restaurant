<?php 
error_reporting(1);
session_start();
$connect = mysqli_connect("localhost", "root", "", "restaurant");
mysqli_set_charset($connect,'utf8');
if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="index.php"</script>';
			}
		}
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Webslesson Demo | Simple PHP Mysql Shopping Cart</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<br />
		<div class="container">
			<br />
			<br />
			<br />
			<h3 align="center">Tutorial - <a href="http://www.webslesson.info/2016/08/simple-php-mysql-shopping-cart.html" title="Simple PHP Mysql Shopping Cart">Simple PHP Mysql Shopping Cart</a></h3><br />
			<br /><br />
			<?php
				if(!empty($_SESSION["shopping_cart"])) {
					$cart_count = count(array_keys($_SESSION["shopping_cart"])); ?>
					<div class="cart_div" style="text-align: right;">
						<a href="cart.php"><img src="cart-icon.png" /> Cart<span> (<?php echo $cart_count; ?>)</span></a>
					</div>
				<?php
				}
				$query = "SELECT * FROM products, images WHERE products.id = images.product_id";
				$result = mysqli_query($connect, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
			<div class="col-md-4">
				<form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">
					<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
						<img src="images/<?php echo $row["link"]; ?>" style="height: 200px; width: 280px;" class="img-responsive" /><br />

						<h4 class="text-info"><?php echo $row["product_name"]; ?></h4>

						<h4 class="text-danger">$ <?php echo number_format($row["prices"]); ?></h4>

						<!-- <input type="text" name="quantity" value="1" class="form-control" /> -->

						<select name='quantity' class="form-control" style="width: 60px;">
							<option <?php if($values["item_quantity"]==1) echo "selected";?> value="1">1</option>
							<option <?php if($values["item_quantity"]==2) echo "selected";?> value="2">2</option>
							<option <?php if($values["item_quantity"]==3) echo "selected";?> value="3">3</option>
							<option <?php if($values["item_quantity"]==4) echo "selected";?> value="4">4</option>
							<option <?php if($values["item_quantity"]==5) echo "selected";?> value="5">5</option>
						</select>

						<input type="hidden" name="hidden_name" value="<?php echo $row["product_name"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["prices"]; ?>" />

						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />

					</div>
				</form>
			</div>
			<?php
					}
				}
			?>
			
		</div>
	</div>
	<br />
	</body>
</html>