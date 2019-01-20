<!DOCTYPE html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta charset="utf-8">
<?php 
	session_start();
    $link = mysqli_connect("localhost", "root", "", "restaurant");
    mysqli_set_charset($link,'utf8');
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $code = $_POST['code'];
        $sql = "INSERT INTO categories(cate_name, code) 
            VALUES ('$name', '$code')";
            mysqli_query($link,$sql);
    }
 ?>
<html>
<head>
	<title>
		Thêm danh mục sản phẩm
	</title>
</head>
<body>
	<form style="margin: 5em 30em" action="" method="POST" role="form">
		<legend>Thêm danh mục sản phẩm</legend>
		<div class="form-group">
			<label for="">Name</label>
			<input type="text" class="form-control" name="name" id="" placeholder="Tên danh mục">
			<label for="">Code</label>
			<input type="text" class="form-control" name="code" id="" placeholder="Mã dang mục">
		</div>
		<button type="submit" name="submit" class="btn btn-primary">Submit</button>
	</form>
</body>
</html>