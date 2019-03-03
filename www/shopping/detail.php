<!DOCTYPE html>
<html lang="en">
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
			//找出商品的ids
			$ids = $_GET["ids"];        
	        
	        require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php'; 
	        //下面是商品的数据
	        $itemq = $db->prepare('select * from items where ids = :ids');
	        $itemq->bindValue(':ids',$ids,PDO::PARAM_INT);
	        $itemq->execute();
	        $thing = $itemq->fetchObject(); 

			$itemName = $thing->name;
			$itemPrice = $thing->price;
			$itemCata = $thing->itemcata;
			$itemImg = $thing->image;
			$itemBody = $thing->body;
			
		?>

		<?php
			session_start();
			date_default_timezone_set("PRC");

			//1.找出购物车中多少种商品和总价
			$uid = $_SESSION["uid"];
			$attr = array();

			$query = $db->prepare('select * from login where username = :uid');
			$query->bindValue(':uid',$uid,PDO::PARAM_STR);
			$query->execute();
			$man = $query->fetchObject(); //将用户信息存到$man这个对象里面去 

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

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

				<!-- Product main img -->
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">
							<div class="product-preview">
								<img src=<?php echo "../assets/img/".$itemImg?> alt="">
							</div>

						
						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">
							<div class="product-preview">
								<img src=<?php echo "../assets/img/".$itemImg?> alt="">
							</div>

							
						</div>
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name"><?php echo $itemName?></h2>
							<div>
								<h3 class="product-price">￥<?php echo $itemPrice.".00"?> <del class="product-old-price">￥<?php echo 1.2*$itemPrice?></del></h3>
								<span class="product-available">秒杀中...</span>
							</div>

							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i><a href= <?php echo "../shopcart/add.php?ids=".$ids?> >加购物车</a></button>
							</div>


						</div>
					</div>
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">详细信息</a></li>
								<li><a data-toggle="tab" href="#tab3">评论</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<p><?php echo $itemBody?></p>
										</div>
									</div>
								</div>
								<!-- /tab1  -->

								<!-- tab3  -->
								<div id="tab3" class="tab-pane fade in">
									<div class="row">
										

										<!-- Reviews -->
										<div class="col-md-6">
											<div id="reviews">
												<ul class="reviews">

											 <?php
												//下面是该商品所对应评论的数据
												$comq = $db->prepare('select * from comment where itemid = :ids');
										        $comq->bindValue(':ids',$ids,PDO::PARAM_INT);
										        $comq->execute();
										        // $comArr = $comq->fetchAll();
											    while ( $comment =  $comq->fetchObject() ) {
											      ?>
											          <li>
														<div class="review-heading">
															<h5 class="name"><?php echo $comment->uid; ?></h5>
														</div>

														<div class="review-body">
															<p> <?php echo $comment->body; ?></p>
														</div>

													</li>
 
   											 <?php  } ?>

												</ul>
												
											</div>
										</div>
										<!-- /Reviews -->

										<!-- Review Form -->
										<div class="col-md-3">
											<div id="review-form">
												<form class="review-form"action="../comment/save.php" method="post">
													<input type="hidden" name='itemid' value=<?php echo $ids; ?>/>
													<input type="hidden" name='userid' value='<?php echo $uid; ?>'/>
													<textarea class="input" placeholder="写评论" name="cbody"></textarea>
													<button class="primary-btn">提交</button>
												</form>
											</div>
										</div>
										<!-- /Review Form -->

									</div>
								</div>
								<!-- /tab3  -->


							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
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

		<!-- jQuery Plugins -->
		<script src="../assets/css/detail_css/js/jquery.min.js"></script>
		<script src="../assets/css/detail_css/js/bootstrap.min.js"></script>
		<script src="../assets/css/detail_css/js/slick.min.js"></script>
		<script src="../assets/css/detail_css/js/nouislider.min.js"></script>
		<script src="../assets/css/detail_css/js/jquery.zoom.min.js"></script>
		<script src="../assets/css/detail_css/js/main.js"></script>

	</body>
</html>
