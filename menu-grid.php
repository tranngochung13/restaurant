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
                                $sql = "SELECT * FROM categories WHERE id IN (8,12,16,19) and id = ".$i;
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
                                $sql = "SELECT * FROM products, images, categories WHERE products.id = images.product_id and categories.id = products.category_id and categories.parentID NOT IN(1) and categories.parentID = ".$i;
                                // echo $sql;
                                $result = $link->query($sql);
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {?>
                                        <div class="col-md-4 <?php echo convert_number_to_words($i) ?>" style="margin-top: 30px">
                                            <form method="post" action="menu-grid.php?action=add&codes=<?php echo $row["codes"]; ?>">
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
                                                            <input type="hidden" name="hidden_name" value="<?php echo $row["product_name"]; ?>" />
                                                            <input type="hidden" name="hidden_price" value="<?php echo $row["prices"]; ?>" />
                                                            <i>
                                                                <input type="submit" name="add_to_cart" style="margin-top:5px;" class="" value="Add to Cart" />
                                                            </i>
                                                            
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