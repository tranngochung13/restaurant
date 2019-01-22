<?php include 'connect.php'; ?>
<?php
    $id_product = $_GET['id'];
  $sql = "SELECT * FROM products Where id=$id_product;";
            $result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    if($row = $result->fetch_assoc()) {
        $com_name = $row["product_name"];
        $email = $row["prices"];
        $phone = $row["description"];
        $language = $row["training"];
        $num_emp = $row["quantity_employee"];
        $web = $row["website"];
        $img = $row["img"];
    }
  }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết</title>
    <link rel="stylesheet" type="text/css" media="screen" href="./css/style.css" />
    <script src="s/js/js.js"></script>
     <link href="css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
    </style>
    <!-- -->
    <script>
        
    </script>
    <style >
        body{
            background-image: url(1.jpg);
            width: auto;
             height: 1000px;
            background-size: 100% 100%;
        }
    </style>
</head>

<body>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height: 70px;">
      <div class="container">
         <a href="../index.php" style="margin-left: -50px;"><img src="../img/logo.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        </button>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        </button>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        </button>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        </button><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        </button>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        </button><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        </button>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        </button><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        </button>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        </button>
      </div>
    </nav>

    <main class="container">

        <!-- Left Column / Headphones Image -->
        <div class="left-column">
            <img data-image="red" class="active" src="<?php echo $img;?>" alt="">
        </div>

        <!-- Right Column -->
        <div class="right-column">

            <!-- Product Description -->
            <div class="product-description">
                <h1><?php echo $com_name ?></h1>
                <p>Email: <?php echo $email ?></p>
                <p>SĐT: <?php echo $phone ?></p>
                <p>Ngôn ngữ: <?php echo $language ?></p>
                <P>Số lượng nhân viên: <?php echo $num_emp ?></P>
                <p>Website: <a href="<?php echo $web ?>"><?php echo $web ?></a></p>
            </div>

            <!-- Product Configuration -->
            <div class="product-configuration">
                <!-- Product Color -->
                <div class="product-color">
                    <span>Alumni đang làm tại công ty</span>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Họ & Tên</th>
                                <th scope="col">Khóa</th>
                                <th scope="col">Email</th>
                                <th scope="col">Chuyên mảng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM infor_alumni Where id_productpany=$id_product";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
    // output data of each row
                                while($row = $result->fetch_assoc()) {?>

            
                            <tr>
                                <th scope="row">1</th>
                                <td><?php echo $row["name_alumni"] ?></td>
                                <td><?php echo $row["course"] ?></td>
                                <td><?php echo $row["contact_email"] ?></td>
                                <td><?php echo $row["positions"] ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                         
                        </tbody>
                    </table>

                </div>
    </main>
</body>

</html>