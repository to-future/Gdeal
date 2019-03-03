<?php
    $uid = $_POST['uid'];
    require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php';  
    $query = $db->prepare('update login set Name = :name, Account = :account where UserName = :uid');
    $query->bindValue(':uid',$uid,PDO::PARAM_STR);
    $query->bindValue(':account',$_POST['account'],PDO::PARAM_INT);
    $query->bindValue(':name',$_POST['name'],PDO::PARAM_STR);
    $query->execute();
    header("location:../items/main.php");
?>
