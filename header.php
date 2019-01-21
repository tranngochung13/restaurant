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
                <a class="navbar-brand" href="index.php"><img src="img/logo-1.png" alt=""></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="index.php">Home</a></li>
                    <li class="dropdown submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="menu-grid.php">Menu Grid</a></li>
                            <li><a href="menu-list.php">Menu List</a></li>
                        </ul>
                    </li>
                    <li><a href="pizzas.php">Pizzas</a></li>
                    <li><a href="coffee.php">Coffee</a></li>
                    <li><a href="burgers.php">Burgers</a></li>
                    <li><a href="drinks.php">Drinks</a></li>
                    <li><a href="contact.php">Contact US</a></li>
                    <?php $cart_count = count(array_keys($_SESSION["shopping_cart"])); ?>
                    <li><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"><span> (<?php echo $cart_count; ?>)</span></i></a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
<!--================End Footer Area =================-->