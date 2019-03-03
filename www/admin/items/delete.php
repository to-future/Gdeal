<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Gdeal  删除商品</title>
</head>
<body>	
	<?php $ids = $_GET['ids']; ?>
	<form action="destroy.php" method="post">
		<input type="hidden" name="ids" value = "<?php echo $ids; ?>"/>
		是否删除ID为<?php echo $ids; ?>的商品?
		<input type="submit" value="确定">
	</form>	
</body>
</html>