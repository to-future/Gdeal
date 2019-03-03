<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Gdeal</title>

  <link rel="stylesheet" href="../assets/css/normalize.css">

    <link rel="stylesheet" href="../assets/css/logonstyle.css" media="screen" type="text/css" />

</head>

<body>

  <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Gdeal轻购物</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
    <div class="alarm">
    <?php
        $false = $_GET['false'];
        if ($false==1) {
            echo "没有该邮箱或密码输入错误！";
        }
    ?>
    </div>
	<section class="login-form-wrap">
		<h1>Gdeal 轻购物</h1>
		<form class="login-form" action="logincl.php" method="post">
			<label>
				<input type="email" name="uid" required placeholder="账号">
			</label>
			<label>
				<input type="password" name="pwd" required placeholder="密码">
			</label>
			<input type="submit" value="登录">
		</form>
        <h5><a href="../user/logon.php">注册</a></h5>
	</section>
	<div style="text-align:center;clear:both">

</div>
</body>
</html>

</body>

</html>