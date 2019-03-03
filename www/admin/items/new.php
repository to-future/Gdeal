<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Gdeal  新增商品</title>
</head>
<body>
<h1>新增商品</h1>

<form action="save.php" method="post" enctype="multipart/form-data">
	<label for="name">商品名称</label>
	<input type="text" name="name" value="" />
	<br/>
    <label for="price">价格</label>
    <input type="number" name="price" value="" />
    <br/>
    <?php 
        require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php'; 
        require_once $_SERVER['DOCUMENT_ROOT'].'/inc/common.php'; 
        $query = $db->prepare('select * from itemcata');
        $query->execute();
        $certcata = $query->fetchAll();
    ?>
    <br/>
    <?php
    foreach ($certcata as $thatcata) {
    ?>
        <input type="radio" name="itemcata" value="<?php echo $thatcata[0]; ?>"><?php echo $thatcata[1]?><br>

    <?php }?>
    <br/>
    <label for="cata">仓库所在地</label>
    <input type="text" name="cata" value="" />
    <br/>
    <label for="num">库存</label>
    <input type="number" name="num" value="" />
    <br/>
    <label for="body">详细介绍</label>
    <textarea name="body"></textarea>
    <br/>
    <label for="file">上传图片</label>
    <input type="file" name="upload"  /> 
    <br />
    <input type="submit" value="提交" />
</form>

</body>
</html>