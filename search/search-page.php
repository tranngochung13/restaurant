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
						 	$show = "SELECT * FROM products WHERE product_name = '$set'";
						    $result = mysqli_query($link,$show);
						    while ($rows = mysqli_fetch_array($result)) {
						    	echo $rows['product_name'];
						    }
						}else{
						 	echo "Nothing";
						}
					?>
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