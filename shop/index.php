<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "restaurant");
?>


<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Top Food-Porucivanje za firme</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
<div class="container" style="width:60%;">
    <h2 align="center">Top Food kolica</h2>
    <br />
    <form>
    <input type="textbox" name="ime_firme" placeholder="Ime firme">
    <input type="textbox" name="ime" placeholder="Ime">
    <input type="textbox" name="prezime" placeholder="Prezime">
    </form>
    <br />
    <br />
    <?php
    $query = "SELECT `id`, `product_name`, `prices` FROM `products` WHERE 1";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            ?>
            <div class="col-md-3">
            <form method="post" action="shop.php?action=add&id=<?php echo $row["id"]; ?>">
            <div style="border: 1px solid #eaeaec; margin: -1px 19px 3px -1px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding:10px;" align="center">
            <img src="<?php echo $row["image"]; ?>" class="img-responsive">
            <h5 class="text-info"><?php echo $row["product_name"]; ?></h5>
            <h5 class="text-danger"> <?php echo $row["prices"]; ?> RSD</h5>
            <input type="text" name="quantity" class="form-control" value="1">
            <input type="hidden" name="hidden_name" value="<?php echo $row["product_name"]; ?>">
            <input type="hidden" name="hidden_price" value="<?php echo $row["prices"]; ?>">
            <input type="submit" name="add" style="margin-top:5px;" class="btn btn-default" value="Dodaj u kolica">
            </div>
            </form>
            </div>
            <?php
        }
    }
    ?>
    <div style="clear:both"></div>
    <h2>Moja kolica</h2>
    <div class="table-responsive">
    <table class="table table-bordered">
    <tr>
    <th width="40%">Ime proizvoda</th>
    <th width="10%">Kolicina</th>
    <th width="20%">Cena</th>
    <th width="15%">Ukupno</th>
    <th width="5%">Komanda</th>
    </tr>
    <?php
    if(!empty($_SESSION["cart"]))
    {
        $total = 0;
        foreach($_SESSION["cart"] as $keys => $values)
        {
            ?>
            <tr>
            <td name="ime"><?php echo $values["item_name"]; ?></td>
            <td><?php echo $values["item_quantity"] ?> X</td>
            <td> <?php echo $values["product_price"]; ?> RSD</td>
            <td> <?php echo number_format($values["item_quantity"] * $values["product_price"], 2); ?> RSD</td>
            <td><a href="shop.php?action=delete&id=<?php echo $values["product_id"]; ?>"><span class="text-danger">Ukloni</span></a></td>
            </tr>
            <?php 
            $total = $total + ($values["item_quantity"] * $values["product_price"]);
        }
        ?>
        <tr>
        <td colspan="3" align="right">Ukupno</td>
        <td align="right"> <?php echo number_format($total, 2); ?> RSD</td>
        <td></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <input type="submit" value="Poruci">
    </div>
    </div>

    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn -> connect_error) {
    die("Connection failed: " . $conn -> connect_error);
} 

$sql = "INSERT INTO tut (p_name, price)
VALUES ('{$mysqli->real_escape_string($_POST['ime'])}')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

 </body>
</html>