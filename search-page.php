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
                    <?php  
						error_reporting(1);
						$link = mysqli_connect("localhost", "root", "", "restaurant");
						 
						// Check connection
						if($link === false){
						    die("ERROR: Could not connect. " . mysqli_connect_error());
						}
						mysqli_set_charset($link,'utf8');
						$set = $_POST['search'];
						if ($set) {
                            $duongdan = './Admin/image-food/image/';


                            for ($i=0; $i <= 99; $i++) { 
                                $show = "SELECT * FROM products, images, categories WHERE products.id = images.product_id and categories.id = products.category_id and product_name = '$set' and categories.parentID = ".$i;
                                $result = mysqli_query($link,$show);
                            while ($row = mysqli_fetch_array($result)) { ?>
                                <div class="col-md-12 <?php echo convert_number_to_words($i) ?>" style="margin-top: 30px">
                                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                        <img style="width: 100%;" src="<?php echo $duongdan.$row["link"] ?>" alt="">
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="text-align: left;">
                                        <form method="post" action="menu-grid.php?action=add&codes=<?php echo $row["codes"]; ?>">
                                            <div class="page-header">
                                                <h1>Chi tiết món ăn</h1>
                                            </div>
                                            <div class="form-group">
                                                <label>Tên món ăn</label>
                                                <p class="form-control-static"><?php echo $row["product_name"] ; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <label>Giá thành</label>
                                                <p class="form-control-static"><?php echo $row["prices"]; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <label>Mô tả thêm về món ăn</label>
                                                <p class="form-control-static"><?php echo $row["description"]; ?></p>
                                            </div>
                                            <div>
                                                <input type="hidden" name="quantity" value="1" />
                                                <input type="hidden" name="hidden_name" value="<?php echo $row["product_name"]; ?>" />
                                                <input type="hidden" name="hidden_price" value="<?php echo $row["prices"]; ?>" />
                                                <a href="index.php" class="btn btn-primary">Back</a>
                                                <input type="submit" name="add_to_cart" class="btn btn-success" value="Add to Cart" />
                                            </div>

                                            <!-- <div class="feature_left" name="hidden_name"><a href="#"><span><?php echo $row["product_name"] ?></span></a></div>
                                            <div class="feature_right" name="hidden_price"><?php echo $row["prices"] ?></div>
                                            <div><?php echo $row["description"] ?></div>
                                             -->
                                        </form>
                                    </div>
                                    
                                </div>
                        <?php   
                            }
                        }
                    }
                    ?>   
                </div>
                <div class="container" style="margin-top: 60px">
                    <h1>Món ăn liên quan</h1>
                    <div class="feature_slider">
                        
                        <?php
                            error_reporting(1);
                            
                            $duongdan = 'Admin/image-food/image/';
                            $sql = "SELECT * FROM products, images, categories WHERE products.id = images.product_id and categories.id = products.category_id";
                            // echo $sql;
                            $result = $link->query($sql);
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                ?>
                                <div class="item">
                                    <div class="feature_item"  style="margin-top: 30px">
                                            <div class="feature_item_inner">
                                                <img style="width: 100%; height: 250px" src="<?php echo $duongdan.$row["link"] ?>" alt="">
                                                <div class="icon_hover">
                                                    <i class="fa fa-search"></i>
                                                    <i class="fa fa-shopping-cart"></i>
                                                </div>
                                            </div>
                                            <div class="title_text">
                                                <div class="feature_left"><a href="table.html"><span><?php echo $row["product_name"] ?></span></a></div>
                                                <div class="restaurant_feature_dots"></div>
                                                <div class="feature_right"><?php echo $row["prices"] ?></div>
                                            </div>
                                    </div>
                                </div>
                                <?php
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