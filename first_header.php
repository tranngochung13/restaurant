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
                    <a href="#"><i class="fa fa-phone"></i>+1 (168) 314 5016</a>
                    <a href="#"><i class="fa fa-envelope-o"></i>+1 (168) 314 5016</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="header_social" style="margin-right: -490px;">
                    <ul>
                    <?php
                        session_start();
                        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                            echo '<a href="#">'.$_SESSION["username"].'</a>';
                            echo '<p><a href="regform/logout.php" class="btn btn-primary">Log out</a></p>';
                        } else{
                            echo '<a href="regform/login.php"><button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#login"><i class="fa fa-address-book" aria-hidden="true"></i> Login</button></a>'.'<a href="regform/register.php"><button type="button" class="btn btn-danger btn-lg"><i class="fa fa-address-card" aria-hidden="true"></i> Register</button></a>';
                        }                    
                    ?>
                        <!-- <a href="regform/login.php"><button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#login"><i class="fa fa-address-book" aria-hidden="true"></i> Login</button></a>
                       <a href="regform/register.php"><button type="button" class="btn btn-danger btn-lg"><i class="fa fa-address-card" aria-hidden="true"></i> Register</button></a>   -->                          
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--================End Footer Area =================-->