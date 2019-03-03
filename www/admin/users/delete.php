<?php
    $uid = $_GET['uid'];
    require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php';  
    $query = $db->prepare('delete from login where UserName = :uid');
    $query->bindValue(':uid',$uid,PDO::PARAM_STR);
    $query->execute();
    header("location:../items/main.php");
?>