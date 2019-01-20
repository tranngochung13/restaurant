<!DOCTYPE html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta charset="utf-8">
<?php 
	session_start();
    error_reporting(1);
    $link = mysqli_connect("localhost", "root", "", "restaurant");
    mysqli_set_charset($link,'utf8');
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $prices = $_POST['price'];
        $description = $_POST['description'];
        $cate_id = $_POST['category'];
        $status = $_POST['status'];
        
        // $target_file = "./image".basename($_FILES["FileImage"]["name"]);
        // $uploadOk = 1;
        // $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    //     if (move_uploaded_file($_FILES["FileImage"]["tmp_name"], $target_file)) {
    //     echo "The file ". basename( $_FILES["FileImage"]["name"]). " has been uploaded.";
    //     } else {
    //     echo "Sorry, there was an error uploading your file.";
    //     }

        // $image=basename( $_FILES["FileImage"]["name"],".jpg");
        $sql = "INSERT INTO foods(food_name, prices, description,category_id,status) 
            VALUES ('$name', '$prices', '$description','$cate_id','$status')";
            mysqli_query($link,$sql);
        // echo "Your add has been submited, you will be redirected to your account page in 3 seconds....";
        // header( "Refresh:3; url=account.php", true, 303);
   
        // display();
        // function display(){
        //     $link = mysqli_connect("localhost", "root", "", "restaurant");
        //     $show = "SELECT * FROM foods";
        //     $query = mysqli_query($link,$show);
        //     $num=mysqli_num_rows($query);
        //     for ($i=0; $i < $num; $i++) { 
        //         $result = mysqli_fetch_array($query);
        //         $img = $result['image'];
        //         echo "<img src='data:image;base64,".$img."'>";
        //     }

    }
   
 ?>
<html>
<head>
	<title>
		Thêm món ăn
	</title>
</head>
<body>
	<form style="margin: 5em 30em" action="product.php" method="POST" role="form" enctype="multipart/form-data">
		<legend>Thêm món ăn</legend>
		<div class="form-group">
			<label for="">Name</label>
			<input type="text" class="form-control" name="name" id="" placeholder="Tên món ăn">
		</div>
		<div class="form-group">
			<label for="">Price</label>
			<input type="number" class="form-control" name="price" id="" placeholder="Giá tiền">
		</div>
		<div class="form-group">
			<label for="">Decription</label>
			<input type="text" class="form-control" name="description" id="" placeholder="Mô tả">
		</div>
		<div class="form-group">
            <label> Danh mục sản phẩm </label>
            <select class="form-control" name="category">
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
<!--         <div class="form-group">
            <label> Chọn hình ảnh sản phẩm </label>
            <input type="file" name="FileImage" required>
        </div> -->
        <div class="form-group">
            <label for="">Status</label>
            <input type="text" class="form-control" name="status" id="status" placeholder="Status">
        </div>
		<button type="submit" name="submit" class="btn btn-primary">Submit</button>
	</form>
</body>
</html>