<?php
function convert_number_to_words($number) {
 
$hyphen      = ' ';
$conjunction = '  ';
$separator   = ' ';
$negative    = 'âm ';
$decimal     = ' phẩy ';
$dictionary  = array(
0                   => 'Không',
1                   => 'Một',
2                   => 'Hai',
3                   => 'Ba',
4                   => 'Bốn',
5                   => 'Năm',
6                   => 'Sáu',
7                   => 'Bảy',
8                   => 'Tám',
9                   => 'Chín',
10                  => 'Mười',
11                  => 'Mười một',
12                  => 'Mười hai',
13                  => 'Mười ba',
14                  => 'Mười bốn',
15                  => 'Mười năm',
16                  => 'Mười sáu',
17                  => 'Mười bảy',
18                  => 'Mười tám',
19                  => 'Mười chín',
20                  => 'Hai mươi',
30                  => 'Ba mươi',
40                  => 'Bốn mươi',
50                  => 'Năm mươi',
60                  => 'Sáu mươi',
70                  => 'Bảy mươi',
80                  => 'Tám mươi',
90                  => 'Chín mươi',
100                 => 'trăm',
1000                => 'ngàn',
1000000             => 'triệu',
1000000000          => 'tỷ',
1000000000000       => 'nghìn tỷ',
1000000000000000    => 'ngàn triệu triệu',
1000000000000000000 => 'tỷ tỷ'
);
 
if (!is_numeric($number)) {
return false;
}
 
if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
// overflow
trigger_error(
'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
E_USER_WARNING
);
return false;
}
 
if ($number < 0) {
return $negative . convert_number_to_words(abs($number));
}
 
$string = $fraction = null;
 
if (strpos($number, '.') !== false) {
list($number, $fraction) = explode('.', $number);
}
 
switch (true) {
case $number < 21:
$string = $dictionary[$number];
break;
case $number < 100:
$tens   = ((int) ($number / 10)) * 10;
$units  = $number % 10;
$string = $dictionary[$tens];
if ($units) {
$string .= $hyphen . $dictionary[$units];
}
break;
case $number < 1000:
$hundreds  = $number / 100;
$remainder = $number % 100;
$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
if ($remainder) {
$string .= $conjunction . convert_number_to_words($remainder);
}
break;
default:
$baseUnit = pow(1000, floor(log($number, 1000)));
$numBaseUnits = (int) ($number / $baseUnit);
$remainder = $number % $baseUnit;
$string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
if ($remainder) {
$string .= $remainder < 100 ? $conjunction : $separator;
$string .= convert_number_to_words($remainder);
}
break;
}
 
if (null !== $fraction && is_numeric($fraction)) {
$string .= $decimal;
$words = array();
foreach (str_split((string) $fraction) as $number) {
$words[] = $dictionary[$number];
}
$string .= implode(' ', $words);
}
 
return $string;
}

echo convert_number_to_words(99);
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
                <div class="popular_filter">
                    <ul>
                        <li class="active" data-filter="*"><a href="">All</a></li>
                        <!-- <li data-filter=".break"><a href="">Breakfast</a></li>
                        <li data-filter=".lunch"><a href="">Lunch</a></li>
                        <li data-filter=".dinner"><a href="">Dinner</a></li>
                        <li data-filter=".snacks"><a href="">Snacks</a></li>
                        <li data-filter=".coffee"><a href="">Coffee</a></li> -->
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
        for ($i=1; $i <= 5; $i++) { 
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
                            $sql = "SELECT * FROM foods, image, categories WHERE foods.id = image.food_id and categories.id = foods.category_id";
                            // echo $sql;
                            $result = $link->query($sql);
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {?>
                                    <div class="col-md-6 <?php echo convert_number_to_words(1); ?>">
                                        <div class="media">
                                            <div class="">
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
                                        </div>
                                    </div>
                                <?php
                                }
                            }
                            ?>

                        <div class="col-md-12 2">
                            <div class="media">
                                <?php
                                    error_reporting(1);
                                    $link = mysqli_connect("localhost", "root", "", "restaurant");
                                    mysqli_set_charset($link,'utf8');
                                    $duongdan = './Admin/image-food/image/';
                                    $sql = "SELECT * FROM foods, image, categories WHERE foods.id = image.food_id 
                                    and categories.id = foods.category_id";
                                    // echo $sql;
                                    $result = $link->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                      while($row = $result->fetch_assoc()) {?>
                                            <!-- <div class="col-md-3 col-sm-9">
                                                    
                                                    <p style="color: red;"><?php echo $row["food_name"] ?></p><br>
                                                    <img style="height: 30%; margin-top: 100px;" src="<?php echo $duongdan.$row["link"] ?>" alt=""><br>
                                                    <?php echo $row["prices"] ?><br>
                                                    <?php echo $row["description"] ?><br>
                                                    <?php echo $row["cate_name"] ?><br>
                                                    
                                                     <?php echo "SELECT link FROM foods WHERE food_id = ".$row['id'] ?><br>
                                               
                                    </div> -->
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
        for ($i=1; $i <= 5; $i++) { 
			$sql = "SELECT * FROM categories WHERE id = ".$i;
        // echo $sql;
        $result = $link->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) { ?>
                <li data-filter=".break"><a href=""><?php echo $row["cate_name"] ?></a></li>
            <?php
            }
        }
		} 
    ?>
</body>
</html>