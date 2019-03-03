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
    ?>

        <h3>商品名称</h3>
        <?php echo $thing->name; ?>
        <br/>
        <h3>价格</h3>>
        <?php echo $thing->price; ?>
        <br/>
        <h3>种类</h3>>
        <?php echo $thing->itemcata; ?>
        <br/>
        <h3>仓库所在地</h3>>
        <?php echo $thing->cata; ?>
        <br/>
        <h3>库存</h3>>
        <?php echo $thing->num; ?>
        <br/>
        <h3>详细介绍</h3>>
        <?php echo $thing->body; ?>
        <br/>
        <p>原图：</p>
        <img src="<?php echo '/assets/img/'.$thing->image?>" >
        <a href='main.php?group=all'>返回主页</a>
</body>
</html>