
<?php 
    include 'connect.php';
    session_start();
    error_reporting(1);
    include("shopping_cart.php"); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('head.php'); ?>
    </head>
    <body>
        <?php include('first_header.php'); ?>
        
        <div class="container-fluid">
            <section class="our_feature_area">
                <div class="detail">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <?php 
                                $id = $_GET['id'];
                                $duongdan = 'Admin/image-food/image/';
                                $sql = "SELECT * FROM images WHERE product_id =".$id;
                                $result = $link->query($sql);
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    if($row = $result->fetch_assoc()) {
                                       ?>
                                            <img style="padding-left: 100px; width: 500px; height: 400px" src="<?php echo $duongdan.$row["link"] ?>" alt="">
                                            
                                       <?php
                                    }
                                } 
                            ?>

                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <?php 
                                if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
                                    $sql = "SELECT * FROM products WHERE id =".$id; 
                                        $result = $link->query($sql);
                                        if ($result->num_rows > 0) {
                                            if(mysqli_num_rows($result) == 1){
                                                if($row = $result->fetch_assoc()) {
                                                $food_name = $row["product_name"];
                                                $prices = $row["prices"];
                                                $description = $row["description"];
                                                $category_id = $row["category_id"];
                                                $status = $row["status"];
                                                $code = $row["codes"];
                                            } else{
                                                // URL doesn't contain valid id parameter. Redirect to error page
                                                header("location: error.php");
                                                exit();
                                            }
                                        } else{
                                            echo "Oops! Something went wrong. Please try again later.";
                                        }
                                    }
                                    // Close statement
                                    mysqli_stmt_close($stmt);
                                    
                                    // Close connection
                                   
                                } else{
                                    // URL doesn't contain id parameter. Redirect to error page
                                    header("location: error.php");
                                    exit();
                                }
                            ?>
                            <div class="page-header">
                        <h1>Chi tiết món ăn</h1>
                    </div>
                        <div class="form-group">
                            <label>Tên món ăn</label>
                            <p class="form-control-static"><?php echo $food_name ; ?></p>
                        </div>
                        <div class="form-group">
                            <label>Giá thành</label>
                            <p class="form-control-static"><?php echo $row["prices"]; ?></p>
                        </div>
                        <div class="form-group">
                            <label>Mô tả thêm về món ăn</label>
                            <p class="form-control-static"><?php echo $row["description"]; ?></p>
                        </div>
                        
                       
                        <p><a href="index.php" class="btn btn-primary">Back</a></p>
                            </div>
                        </div>
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
        </section>
        </div>
       
        <?php include('footer.php'); ?>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery-2.1.4.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Rev slider js -->
        <script src="vendors/revolution/js/jquery.themepunch.tools.min.js"></script>
        <script src="vendors/revolution/js/jquery.themepunch.revolution.min.js"></script>
        <script src="vendors/revolution/js/extensions/revolution.extension.video.min.js"></script>
        <script src="vendors/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
        <script src="vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
        <script src="vendors/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
        <script src="vendors/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
        <!-- Extra plugin js -->
        <script src="vendors/bootstrap-selector/bootstrap-select.js"></script>
        <script src="vendors/bootatrap-date-time/bootstrap-datetimepicker.min.js"></script>
        <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
        <script src="vendors/isotope/isotope.pkgd.min.js"></script>
        <script src="vendors/countdown/jquery.countdown.js"></script>
        <script src="vendors/js-calender/zabuto_calendar.min.js"></script>
        <!--gmaps Js-->
        <!--        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>-->
        <!--        <script src="js/gmaps.min.js"></script>-->
        <!--        <script src="js/video_player.js"></script>-->
        <script src="js/theme.js"></script>
    </body>
</html>