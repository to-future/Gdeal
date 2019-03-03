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

$uid = $_SESSION["uid"];

$query = $db->prepare('select * from login where username = :uid');
$query->bindValue(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$man = $query->fetchObject();  

$query = $db->prepare('select * from orders where user_id = :uid');
$query->bindValue(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$my_order = $query->fetchAll();  

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
                                <a href="../shopping/main.php?group=0" class="logo">
                                    <img src="../assets/css/detail_css/img/logo.png" alt="">
                                </a>
                            </div>
                        </div>
                        <!-- /LOGO -->

                        <!-- SEARCH BAR -->
                        <div class="col-md-6">
                            <div class="header-search">
                                <form>
                                    <select class="input-select">
                                        <option value="0">手机</option>
                                        <option value="1">电脑</option>
                                        <option value="1">耳机</option>
                                    </select>
                                    <input class="input" placeholder="Gdeal">
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

        <!-- SECTION -->
        <div class="section">
            <!-- container -->
            <div class="container">
                    <!-- Order Details -->
                    <div class="col-md-5 order-details">
                        <div class="section-title text-center">
                            <h3 class="title">您过去的订单</h3>
                        </div>
                        <div class="order-summary">
                            <div class="order-col">
                                <div><strong>订单内容</strong></div>
                                <div><strong>购买时间</strong></div>
                            </div>
                            <div class="order-products">
                                <?php foreach ($my_order as $thing) { 
                                    $query = $db->prepare('select * from items where ids = :ids');
                                    $query->bindValue(':ids',$thing[2],PDO::PARAM_INT);
                                    $query->execute();
                                    $thinginfo = $query->fetchObject();//得到这个东西的信息
                                ?>
                                  
                                    <div class="order-col">
                                        <!-- 购物车里的信息这样子呈现：IphoneX x3-->
                                        <div><?php echo $thinginfo->name?>  ×<?php echo $thing[3]?> <?php echo "￥".$thinginfo->price.".00"?></div>
                                        <div><?php echo date($thing[4])?></div>
                                    </div>
                              
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <!-- /Order Details -->
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /SECTION -->

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