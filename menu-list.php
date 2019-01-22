<?php include("shopping_cart.php"); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('head1.php'); ?>
    </head>
    <body>
       
        <?php include('first_header.php') ?>
        <?php include('header.php') ?>
        
        
        
        <!--================Banner Area =================-->
        <section class="banner_area">
            <div class="container">
                <div class="banner_content">
                    <h4>Menu List</h4>
                    <a href="index.php">Home</a>
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
                            for ($i=0; $i <= 99; $i++) { 
                                $sql = "SELECT * FROM products, images, categories WHERE products.id = images.product_id and categories.id = products.category_id and products.category_id = ".$i;
                                // echo $sql;
                                $result = $link->query($sql);
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {?>
                                        <div class="col-md-6 <?php echo convert_number_to_words($i) ?>">
                                            <form method="post" action="menu-list.php?action=add&codes=<?php echo $row["codes"]; ?>">
                                                <div class="media">
                                                    <div class="">
                                                        <div class="media-left">
                                                            <img style="height: 180px; width: 180px;" src="<?php echo $duongdan.$row["link"] ?>" alt="">
                                                        </div>
                                                        <div class="media-body">
                                                            <a href="detail.php?id=<?php echo $row["ID_company"] ?>"><h3 name="hidden_name"><?php echo $row["product_name"] ?></h3></a>
                                                            <h4 name="hidden_price"><?php echo $row["prices"] ?></h4>
                                                            <p><?php echo $row["description"] ?></p>
                                                            <p><?php echo $row["cate_name"] ?></p>

                                                            <input type="hidden" name="quantity" value="1" />
                                                            <input type="hidden" name="hidden_name" value="<?php echo $row["product_name"]; ?>" />
                                                            <input type="hidden" name="hidden_price" value="<?php echo $row["prices"]; ?>" />
                                                            <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />

                                                            <!-- <a class="read_mor_btn" href="#">Add To Cart</a> -->
                                                            <ul>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star-half-o"></i></a></li>
                                                            </ul>
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
        
        <?php include('footer.php'); ?>

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