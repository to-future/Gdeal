<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php'; 
session_start();
//找出点击"购买"的ids
$ids = $_GET["ids"];//商品id
$uid = $_SESSION["uid"];//用户id

$query = $db->prepare('select * from shopcart where user_id = :uid and item_id = :ids');
$query->bindValue(':uid',$uid,PDO::PARAM_STR);
$query->bindValue(':ids',$ids,PDO::PARAM_INT);
$query->execute();
$that_order = $query->fetchObject();  

if(empty($that_order))//如果购物车里没有这条记录
{
    $query = $db->prepare("insert into shopcart(order_id, user_id, item_id, item_num) values('', :uid, :ids, 1)");
    $query->bindValue(':uid',$uid,PDO::PARAM_STR);
    $query->bindValue(':ids',$ids,PDO::PARAM_INT);
    $query->execute();
}else
{
    // 如果购物车中此人已经添加了该商品将商品个数加一
    $query = $db->prepare('update shopcart set item_num = :newnum where user_id = :uid and item_id = :ids');
    $query->bindValue(':uid',$uid,PDO::PARAM_STR);
    $query->bindValue(':ids',$ids,PDO::PARAM_INT);
    $query->bindValue(':newnum',1+$that_order->item_num,PDO::PARAM_INT);
    $query->execute();

}
header("location:../shopping/main.php?group=0"); 