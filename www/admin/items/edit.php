<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Gdeal  修改商品</title>
</head>
<body>
	<?php 
	
    require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'].'/inc/common.php'; 
		$ids = $_GET['ids'];
	    $query = $db->prepare('select * from items where ids = :id');
	    $query->bindValue(':id',$ids,PDO::PARAM_INT);
	    $query->execute();
	    $thing = $query->fetchObject();

	    $query = $db->prepare('select * from itemcata');
	    $query->execute();
	    $catakinds = $query->fetchAll();
	?>
	<h1>编辑商品:</h1>

	<form action="update.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="ids" value = "<?php echo $ids; ?>"/>
		<label for="name">商品名称</label>
		<input type="text" name="name" value="<?php echo $thing->name; ?>" />
		<br/>
	    <label for="price">价格</label>
	    <input type="number" name="price" value="<?php echo $thing->price; ?>" />
	    <br/>
	    <label for="itemcata">原本所属类：</label>
		<?php 
			$query = $db->prepare('select * from itemcata where Id='.$thing->itemcata);
		    $query->execute();
		    $certcata = $query->fetchAll();
	    	echo $certcata[0][1]; 
	    ?>
	    <br/>
	<?php
	foreach ($catakinds as $thatcata) {
	?>
		<input type="radio" name="itemcata" value="<?php echo $thatcata[0]; ?>"><?php echo $thatcata[1]?><br>

	<?php }?>
	    <br/>
	    <label for="cata">仓库所在地</label>
	    <input type="text" name="cata" value="<?php echo $thing->cata; ?>" />
	    <br/>
	    <label for="num">库存</label>
	    <input type="number" name="num" value="<?php echo $thing->num; ?>" />
	    <br/>
	    <label for="body">详细介绍</label>
	    <textarea name="body"><?php echo $thing->body; ?></textarea>
	    <br/>
	    <p>原图：</p>
	    <img src="<?php echo '/assets/img/'.$thing->image; ?>" >
	    <input type="submit" value="不更改图片提交" />
	</form>
	<a href= <?php echo "pic.php?ids=".$ids;?> >需要更改图片</a>
</body>
</html>