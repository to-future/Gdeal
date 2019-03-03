<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gdeal</title>
<style>
#table-1 thead, #table-1 tr {
border-top-width: 1px;
border-top-style: solid;
border-top-color: rgb(65,105,225);
}
#table-1 {
border-bottom-width: 1px;
border-bottom-style: solid;
border-bottom-color: rgb(65,105,225);
}

/* Padding and font style */
#table-1 td, #table-1 th {
padding: 5px 10px;
font-size: 16px;
font-family: Verdana;
color: rgb( 100,149,237);
}

/* Alternating background colors */
#table-1 tr:nth-child(even) {
background: rgb(176,196,222)
}
#table-1 tr:nth-child(odd) {
background: #FFF
}
</style>
</head>

<body>
<h1>Gdeal-轻量的购物体验--后台</h1>

<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php'; 
date_default_timezone_set("PRC");

?>

<table id = "table-1">
    <tr>
        <td>名称</td>
        <td>价格</td>
        <td>分类</td>
        <td>库存</td>
        <td>操作</td>
    </tr>
    <?php
        $query = $db->prepare('select * from items');
        $query->execute();
        $arr = $query->fetchAll();   
        
        foreach($arr as $v)
        {
            echo "<tr>
            <td><a href='detail.php?ids={$v[0]}'>$v[1]</a></td>
            <td>$v[2]</td>
            <td>$v[3]</td>
            <td>$v[5]</td>
            <td>
            <a href='edit.php?ids={$v[0]}'>改</a>
            <a href='delete.php?ids={$v[0]}'>删</a>
            </td>
            ";   
        }
    ?>
    
</table>
<a href="new.php">新增商品</a>
<!-- 用户 -->
<table id = "table-1">

<tr>
    <td>账号</td>
    <td>昵称</td>
    <td>余额</td>
    <td>操作</td>
</tr>

<?php
$query = $db->prepare('select * from login');
$query->execute();
while ($man = $query->fetchObject()) {
?>

<tr>
    <td><?php echo $man->UserName;?></td>
    <td><?php echo $man->Name;?></td>
    <td><?php echo $man->Account;?></td>
    <td>
        <a href=<?php echo "../users/delete.php?uid=".$man->UserName;?>>删</a><a href=<?php echo "../users/edit.php?uid=".$man->UserName;?>>改</a>
    </td>

<?php }?>
    
</table>
<!-- 类别 -->
<br>
<h5>当前所有类别：</h5>
    <?php 
        $query = $db->prepare('select * from itemcata');
        $query->execute();
        $catakinds = $query->fetchAll();
        foreach ($catakinds as $c){
            echo $c[1].'  '; 
        }
    ?>
<br>

<h5>删除选中种类：</h5>
    <br/>
    <form action="../catas/deletecata.php" method="post">
        <?php
        foreach ($catakinds as $thatcata) {?>
            <input type="checkbox" name="deletecata[]" value="<?php echo $thatcata[0]; ?>"><?php echo $thatcata[1]?>
            <br>
        <?php }?>
        <input type="submit" value="删除" />
    </form>


<h5>新增种类：</h5>  
    <form action="../catas/savecata.php" method="post">
        <label for="name">种类名称不超过30字符：</label>
        <input type="text" maxlength="30" name="newcataname"/>
        <input type="submit" value="新增" />
    </form>
</body>
</html>