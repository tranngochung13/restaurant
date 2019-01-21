<?php include("shopping_cart.php") ?>
<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'restaurant');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($link,'utf8');
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
session_start();
if(isset($_POST["add_to_cart"])){
if (isset($_SESSION["shopping_cart"])) {
$sql = "INSERT INTO `orders` (user_id,order_date) values (?,CURDATE())";
mysqli_set_charset($link, 'UTF8');

if($stmt = $link->prepare($sql)){
   // Bind variables to the prepared statement as parameters
    $stmt->bind_param("s", $_SESSION['username']);
    $time = "CURDATE()";
    $stmt->execute();
}
$order_id=0;
$sql1= "SELECT *from orders where user_id = ".$_SESSION['username']." and dates = CURDATE()" ;
$result = $link->query($sql1);
if($result){
    while($row1 = $result->fetch_array(MYSQLI_ASSOC)){
        $order_id = $row1['id'];
    }
}
$giohang = $_SESSION['add_to_cart'];
foreach($giohang as $id =>$ls)
{
    $row=mysqli_fetch_row(mysqli_query($link,"SELECT * FROM products WHERE id in ('$id')"));
    // echo $ls;
    $sql2 = "INSERT INTO `orders_detail` values ($order_id,$product_id,$quantity)";
    if ($link->query($sql2) === TRUE) {
        echo("success");
    }
    else { echo "".$link>error;}
    unset($_SESSION['add_to_cart']);}
}
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('head1.php'); ?>
    </head>
    <body>
       
       <div id="preloader">
            <div class="loader absolute-center">
                <div class="loader__box"><b class="top"></b></div>
                <div class="loader__box"><b class="top"></b></div>
                <div class="loader__box"><b class="top"></b></div>
            </div>
        </div>
       
        <!--================ Frist hader Area =================-->
        <div class="first_header">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="header_contact_details">
                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="event_btn_inner">
                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="header_social">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-rss"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--================End Footer Area =================-->
        
        <!--================End Footer Area =================-->
        <header class="main_menu_area">
            <nav class="navbar navbar-default">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"><img src="img/logo-1.png" alt=""></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="menu-grid1.html">Home</a></li>
                            <li class="dropdown submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About US <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="about-us.html">About Us</a></li>
                                    <li><a href="about-us2.html">About Us2</a></li>
                                </ul>
                            </li>
                            <li class="dropdown submenu active">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="menu-grid.php">Menu Grid</a></li>
                                    <li><a href="menu-list.php">Menu List</a></li>
                                </ul>
                            </li>
                            <li><a href="gallery.html">Gallery</a></li>
                            <li class="dropdown submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="event.html">Event</a></li>
                                    <li><a href="table.html">Table</a></li>
                                </ul>
                            </li>
                            <li class="dropdown submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">News <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="blog-gallery.html">Blog Gallery</a></li>
                                    <li><a href="blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.html">Contact US</a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>
        <!--================End Footer Area =================-->
        
        <!--================Banner Area =================-->
        <section class="banner_area">
            <div class="container">
                <div class="banner_content">
                    <h4>Menu Grid</h4>
                    <a href="#">Home</a>
                    <a class="active" href="menu-list.php">Menu</a>
                </div>
            </div>
        </section>
        <!--================End Banner Area =================-->
        
        <!--================End Our feature Area =================-->
        <section class="most_popular_item_area menu_list_page">
            <div class="container">
                <div class="popular_filter">
                    <ul>
                        <li class="active" data-filter="*"><a href="">All</a></li>
                        <?php 
                            error_reporting(1);
                            $link = mysqli_connect("localhost", "root", "", "restaurant");
                            mysqli_set_charset($link,'utf8');
                            for ($i=1; $i < 99; $i++) { 
                                $sql = "SELECT * FROM categories WHERE parentID = 1 and id = ".$i;
                            // echo $sql;
                            $result = $link->query($sql);
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) { ?>
                                    <li data-filter=".<?php echo convert_number_to_words($i); ?>"><a href=""><?php echo $row["cate_name"] ?></a></li>
                                <?php
                                }
                            }
                            }
                                
                        ?>
                    </ul>
                </div>


                <div class="p_recype_item_main">
                    <div class="row p_recype_item_active">
                        <?php
                            error_reporting(1);
                            $link = mysqli_connect("localhost", "root", "", "restaurant");
                            mysqli_set_charset($link,'utf8');
                            $duongdan = './Admin/image-food/image/';
                            if(!empty($_SESSION["shopping_cart"])) {
                    $cart_count = count(array_keys($_SESSION["shopping_cart"])); ?>
                    <div class="cart_div" style="text-align: right;">
                        <a href="cart.php"><img src="cart-icon.png" /> Cart<span> (<?php echo $cart_count; ?>)</span></a>
                    </div>
                <?php
                }
                            for ($i=0; $i <= 99; $i++) { 
                                $sql = "SELECT * FROM products, images, categories WHERE products.id = images.product_id and categories.id = products.category_id and products.category_id = ".$i;
                                // echo $sql;
                                $result = $link->query($sql);
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {?>
                                        <div class="col-md-4 <?php echo convert_number_to_words($i) ?>" style="margin-top: 30px">


                                            <form method="post" action="menu-grid1.php?action=add&codes=<?php echo $row["codes"]; ?>">
                                                <div class="feature_item">
                                                    <div class="feature_item_inner">
                                                        <img style="height: 250px; width: 100%;" src="<?php echo $duongdan.$row["link"] ?>" alt="">
                                                        <div class="title_text">
                                                            <div class="feature_left" name="hidden_name"><a href="#"><span><?php echo $row["product_name"] ?></span></a></div>
                                                            <div class="restaurant_feature_dots"></div>
                                                            <div class="feature_right" name="hidden_price"><?php echo $row["prices"] ?></div>
                                                        </div>
                                                        <div class="icon_hover">
                                                            <input type="hidden" name="quantity" value="1" />
                                                            <input type="hidden" name="hidden_id" value="<?php echo $row["product_id"]; ?>" />
                                                            <input type="hidden" name="hidden_name" value="<?php echo $row["product_name"]; ?>" />
                                                            <input type="hidden" name="hidden_price" value="<?php echo $row["prices"]; ?>" />
                                                            <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    <?php
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Our feature Area =================-->
    </body>
</html>