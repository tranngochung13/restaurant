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
	<section class="most_popular_item_area menu_list_page">
            <div class="container">
                <div class="p_recype_item_main">
                    <div class="row p_recype_item_active">
                        <div class="col-md-12 <?php echo convert_number_to_words(2) ?>">
                            <div class="media">
                                <?php
                                    error_reporting(1);
                                    $link = mysqli_connect("localhost", "root", "", "restaurant");
                                    mysqli_set_charset($link,'utf8');
                                    $duongdan = './Admin/image-food/image/';
                                    for ($i=1; $i <= 6; $i++) { 
                                        $sql = "SELECT * FROM foods, image, categories WHERE foods.id = image.food_id 
                                    and categories.id = foods.category_id and foods.category_id = ".$i;
                                    // echo $sql;
                                    $result = $link->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                      	while($row = $result->fetch_assoc()) {?>
                                    		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        		<div class="media-left">
                                    				<img style="height: 180px; width: 180px;" src="<?php echo $duongdan.$row["link"] ?>" alt="">
                                				</div>
                                				<div class="media-body">
                                    				<a href="#"><h3><?php echo $row["food_name"] ?></h3></a>
				                                    <h4><?php echo $row["prices"] ?></h4>
				                                    <p><?php echo $row["description"] ?></p>
				                                    <p><?php echo $row["cate_name"] ?></p>
				                                    <a class="read_mor_btn" href="#">Add To Cart</a>
				                                    <ul>
				                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
				                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
				                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
				                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
				                                        <li><a href="#"><i class="fa fa-star-half-o"></i></a></li>
				                                    </ul>
				                                </div>
                                    		</div>
                                    	}
                                  	<?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</body>
</html>