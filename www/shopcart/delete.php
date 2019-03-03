<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php'; 
$uid = $_SESSION["uid"];//用户id
$ids = $_GET["ids"];//得到需要删除的商品id

$query = $db->prepare('delete from shopcart where user_id = :uid and item_id = :ids');
$query->bindValue(':uid',$uid,PDO::PARAM_STR);
$query->bindValue(':ids',$ids,PDO::PARAM_INT);
$query->execute();

header("location:show.php"); 
?>