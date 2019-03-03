<?php
session_start();

$uid =$_POST["uid"];
$pwd = $_POST["pwd"];
$another = $_POST["another"];
$nick = $_POST["nickname"];
$beginmoney = 0;

require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php';  

$query = $db->prepare('select * from login where username = :uid');
$query->bindValue(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$arr = $query->fetchObject(); 

if (!empty($arr)) {
    //如果已经存在该邮箱
    header("location:logon.php?false=1");
}elseif ($pwd!=$another) {
    header("location:logon.php?false=2");
}else{
    //检查完毕没有问题的话：
    $sql = "insert into login(username, name, password, account) values(:username,:name,:password,:account);" ;    
    $query = $db->prepare($sql);
    $query->bindParam(':username',$uid,PDO::PARAM_STR);
    $query->bindParam(':name',$nick,PDO::PARAM_STR);
    $query->bindParam(':password',$pwd,PDO::PARAM_STR);
    $query->bindParam(':account',$beginmoney,PDO::PARAM_INT);
    if (!$query->execute()) {   
        print_r($query->errorInfo());
    }else{
        $_SESSION["uid"] =$uid;
        header("location:../shopping/main.php?group=all");
    }
}

?>