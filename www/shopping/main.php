<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Gdeal</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="../assets/css/detail_css//css/bootstrap.min.css"/>

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="../assets/css/detail_css/css/slick.css"/>
    <link type="text/css" rel="stylesheet" href="../assets/css/detail_css/css/slick-theme.css"/>

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="../assets/css/detail_css/css/nouislider.min.css"/>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="../assets/css/detail_css/css/font-awesome.min.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="../assets/css/detail_css/css/style.css"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<?php

session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php'; 
date_default_timezone_set("PRC");

//1.找出购物车中多少种商品和总价
$uid = $_SESSION["uid"];

$query = $db->prepare('select * from login where username = :uid');
$query->bindValue(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$man = $query->fetchObject();  

$query = $db->prepare('select * from shopcart where user_id = :uid');
$query->bindValue(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$incart = $query->fetchAll();  

$gs = count($incart);//$gs 商品数量
$sum = 0;//$sum 总价格,默认总价格为0
foreach($incart as $v)
{
    $query = $db->prepare('select price from items where ids = :ids');
    $query->bindValue(':ids',$v[2],PDO::PARAM_INT);
    $query->execute();
    $ajg = $query->fetchAll();  

    $dj = $ajg[0][0];//单价
    
    $sum += $dj * $v[3];//总价=单价*数量
}
//$gs是购物车东西种类 $sum是总价格
?>
<!-- 获取商品信息存到数组$incart中： -->
<?php
    $ingro = $_GET["group"];
    if ($ingro==0) {

        $query = $db->prepare('select * from items');
        $query->execute();
        $arr = $query->fetchAll();   

    }else{
        
        $query = $db->prepare('select * from items where itemcata = :ingro');
        $query->bindValue(':ingro',$ingro,PDO::PARAM_INT);
        $query->execute();
        $arr = $query->fetchAll();
    }
?>

<!-- HEADER -->
        <header>
            <!-- TOP HEADER -->
            <div id="top-header">
                <div class="container">
                    <ul class="header-links pull-left">
                        <li><a href="#"><i class="fa fa-phone"></i> 8888888888</a></li>
                        <li><a href="#"><i class="fa fa-envelope-o"></i> 88888@163.com</a></li>
                        <li><a href="#"><i class="fa fa-map-marker"></i> 杭州电子科技大学</a></li>
                    </ul>
                    <ul class="header-links pull-right">
                        <li><a href="../user/show.php"><i class="fa fa-dollar"></i> <?php echo $man->Account?></a></li>
                        <li><a href="../user/show.php"><i class="fa fa-user-o"></i> <?php echo $man->Name?></a></li>
                    </ul>
                </div>
            </div>
            <!-- /TOP HEADER -->

            <!-- MAIN HEADER -->
            <div id="header">
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <!-- LOGO -->
                        <div class="col-md-3">
                            <div class="header-logo">
                                <a href="main.php?group=all" class="logo">
                                    <img src="../assets/css/detail_css/img/logo.png" alt="">
                                </a>
                            </div>
                        </div>
                        <!-- /LOGO -->

                        <!-- SEARCH BAR -->
                        <div class="col-md-6">
                            <div class="header-search">
                                <form action="gotitem.php" method="post">
                                    <select class="input-select">
                                    </select>
                                    <input class="input" type = "text" name="keyname" maxlength="30" placeholder="Gdeal">
                                    <button class="search-btn">搜一下</button>
                                </form>
                            </div>
                        </div>
                        <!-- /SEARCH BAR -->

                        <!-- ACCOUNT -->
                        <div class="col-md-3 clearfix">
                            <div class="header-ctn">
                                <!-- Wishlist -->
                                <div>
                                    <a href="../user/dingdan.php">
                                        <i class="fa fa-heart-o"></i>
                                        <span>我的订单</span>
                                    </a>
                                </div>
                                <!-- /Wishlist -->

                                <!-- Cart -->
                                <div class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span>购物车</span>
                                        <!-- 购物车里的东西 -->
                                        <div class="qty"><?php echo $gs?></div>
                                    </a>
                                    <div class="cart-dropdown">
                                        <div class="cart-summary">
                                            <small><?php echo "购物车里共 ".$gs." 种商品"?></small>
                                            <h5>总计: <?php echo "￥".$sum.".00"?></h5>
                                        </div>
                                        <div class="cart-btns">
                                            <a href="../shopcart/show.php">查看详情</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Cart -->

                            </div>
                        </div>
                        <!-- /ACCOUNT -->
                    </div>
                    <!-- row -->
                </div>
                <!-- container -->
            </div>
            <!-- /MAIN HEADER -->
        </header>
        <!-- /HEADER -->


        <!-- NAVIGATION -->
        <nav id="navigation">
            <!-- container -->
            <div class="container">
                <!-- responsive-nav -->
                <div id="responsive-nav">
                    <!-- NAV -->
                    <ul class="main-nav nav navbar-nav">
                        <li class="active"><a href="main.php?group=0">全部商品</a></li>
                        <?php 
                            $query = $db->prepare('select * from itemcata');
                            $query->execute();
                            $catas = $query->fetchAll();
                            foreach ($catas as $thisc) {
                        ?>
                        <li><a href=<?php echo "main.php?group=".$thisc[0]?> ><?php echo $thisc[1]?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                    <!-- /NAV -->
                </div>
                <!-- /responsive-nav -->
            </div>
            <!-- /container -->
        </nav>
        <!-- /NAVIGATION -->

<!-- ////////////////////////////////////////商品///////////////////////////////////////////// -->




        <?php 
        if ($ingro==0) {
        ?>
            <!-- SECTION -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- shop -->
                    <div class="col-md-4 col-xs-6">
                        <div class="shop">
                            <div class="shop-img">
                                <img src="../assets/img/item9.jpg" alt="">
                            </div>
                            <div class="shop-body">
                                <h3>猫王收音机<br>酷品收集</h3>
                                <a href="detail.php?ids=9" class="cta-btn">抢购 <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- /shop -->

                    <!-- shop -->
                    <div class="col-md-4 col-xs-6">
                        <div class="shop">
                            <div class="shop-img">
                                <img src="../assets/img/item10.jpg" alt="">
                            </div>
                            <div class="shop-body">
                                <h3>佳能EOS 80D<br>锋芒毕露</h3>
                                <a href="detail.php?ids=10" class="cta-btn">抢购 <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- /shop -->

                    <!-- shop -->
                    <div class="col-md-4 col-xs-6">
                        <div class="shop">
                            <div class="shop-img">
                                <img src="../assets/img/item8.jpg" alt="">
                            </div>
                            <div class="shop-body">
                                <h3>OnePlus6<br>潮流派对</h3>
                                <a href="detail.php?ids=8" class="cta-btn">抢购 <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- /shop -->
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /SECTION -->

        <?php
        }
        ?>


        <!-- Section -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">

                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <h3 class="title">~Gdeal甄选~</h3>
                        </div>
                    </div>

                    <div class="clearfix visible-sm visible-xs"></div>
                        <?php 
                    foreach ($arr as $v) {
                        ?>
                        <!-- product -->
                        <div class="col-md-3 col-xs-6">
                            <div class="product">
                                <div class="product-img">
                                    <img src=<?php echo "../assets/img/".$v[6];?> alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category"><?php echo $v[4]?></p>
                                    <h3 class="product-name"><a href= <?php echo "detail.php?ids=".$v[0];?> ><?php echo $v[1]?></a></h3>
                                    <h4 class="product-price"><?php echo '￥'.$v[2].'.00'?> <del class="product-old-price"><?php echo 1.2*$v[2]?></del></h4>
                                    <div class="product-rating">
                                    </div>
                                    <div class="product-btns">
                                        <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">收藏</span></button>
                                        <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">分享</span></button>
                                        <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">看一眼</span></button>
                                    </div>
                                </div>
                                <div class="add-to-cart">
                                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> 
                                        <a href=<?php echo "../shopcart/add.php?ids=".$v[0];?>>加购物车</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /product -->
                        <?php
                    }   ?>
                    
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /Section -->


<!-- FOOTER -->
        <footer id="footer">
            <!-- bottom footer -->
            <div id="bottom-footer" class="section">
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <ul class="footer-payments">
                                <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                                <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                            </ul>
                            <span class="copyright">
                                
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by jaywhite                            </span>
                        </div>
                    </div>
                        <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /bottom footer -->
        </footer>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////// -->

        <!-- jQuery Plugins -->
        <script src="../assets/css/detail_css/js/jquery.min.js"></script>
        <script src="../assets/css/detail_css/js/bootstrap.min.js"></script>
        <script src="../assets/css/detail_css/js/slick.min.js"></script>
        <script src="../assets/css/detail_css/js/nouislider.min.js"></script>
        <script src="../assets/css/detail_css/js/jquery.zoom.min.js"></script>
        <script src="../assets/css/detail_css/js/main.js"></script>

</body>
</html>