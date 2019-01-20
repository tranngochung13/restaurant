<?php 
error_reporting(1);
session_start();
include('numberToWord.php');
$connect = mysqli_connect("localhost", "root", "", "restaurant");
mysqli_set_charset($connect,'utf8');
if(isset($_POST["add_to_cart"]))
{
    if(isset($_SESSION["shopping_cart"]))
    {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_GET["codes"], $item_array_id))
        {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id'           =>  $_GET["codes"],
                'item_name'         =>  $_POST["hidden_name"],
                'item_price'        =>  $_POST["hidden_price"],
                'item_quantity'     =>  $_POST["quantity"]
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
            'item_id'           =>  $_GET["codes"],
            'item_name'         =>  $_POST["hidden_name"],
            'item_price'        =>  $_POST["hidden_price"],
            'item_quantity'     =>  $_POST["quantity"]
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
            if($values["item_id"] == $_GET["codes"])
            {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>alert("Item Removed")</script>';
                echo '<script>window.location="cart.php"</script>';
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="img/express-favicon.png" type="image/x-icon" />
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>RedCaynne Re</title>

        <!-- Icon css link -->
        <link href="vendors/material-icon/css/materialdesignicons.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="vendors/linears-icon/style.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Extra plugin css -->
        <link href="vendors/bootstrap-selector/bootstrap-select.css" rel="stylesheet">
        <link href="vendors/bootatrap-date-time/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <link href="vendors/owl-carousel/assets/owl.carousel.css" rel="stylesheet">
        
        <link href="css/style.css" rel="stylesheet">
        <link href="css/responsive.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
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
                            $a = "SELECT count(id) FROM categories";

                            $c=mysqli_query("SELECT count(*) as total from categories");
                            $data=mysqli_fetch_assoc($c);
                            echo $data['total'];

                            $b = $a;
                            echo $c;
                            for ($i=1; $i <= 99; $i++) { 
                                $sql = "SELECT * FROM categories WHERE id = ".$i;
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
                                $sql = "SELECT * FROM foods, image, categories WHERE foods.id = image.food_id and categories.id = foods.category_id and foods.category_id = ".$i;
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
                                                            <div class="feature_left" name="hidden_name"><a href="#"><span><?php echo $row["food_name"] ?></span></a></div>
                                                            <div class="restaurant_feature_dots"></div>
                                                            <div class="feature_right" name="hidden_price"><?php echo $row["prices"] ?></div>
                                                        </div>
                                                        
                                                        
                        <select name='quantity' class="form-control" style="width: 60px;">
                            <option <?php if($values["item_quantity"]==1) echo "selected";?> value="1">1</option>
                            <option <?php if($values["item_quantity"]==2) echo "selected";?> value="2">2</option>
                            <option <?php if($values["item_quantity"]==3) echo "selected";?> value="3">3</option>
                            <option <?php if($values["item_quantity"]==4) echo "selected";?> value="4">4</option>
                            <option <?php if($values["item_quantity"]==5) echo "selected";?> value="5">5</option>
                        </select>

                                                        <div class="icon_hover">
                                                            <input type="hidden" name="hidden_name" value="<?php echo $row["food_name"]; ?>" />
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
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery-2.1.4.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Extra plugin js -->
        <script src="vendors/bootstrap-selector/bootstrap-select.js"></script>
        <script src="vendors/bootatrap-date-time/bootstrap-datetimepicker.min.js"></script>
        <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
        <script src="vendors/isotope/isotope.pkgd.min.js"></script>
        <script src="vendors/countdown/jquery.countdown.js"></script>
        <script src="vendors/js-calender/zabuto_calendar.min.js"></script>

        <script src="js/theme.js"></script>
    </body>
</html>