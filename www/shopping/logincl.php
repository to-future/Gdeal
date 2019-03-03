<?php
session_start();

$uid =$_POST["uid"];
$pwd = $_POST["pwd"];


    require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php';  
    $query = $db->prepare('select * from login where username = :uid');
    $query->bindValue(':uid',$uid,PDO::PARAM_STR);
    $query->execute();
    $arr = $query->fetchObject();   



if($arr->Password==$pwd && !empty($pwd))
{    
    $_SESSION["uid"] =$uid;
    header("location:main.php?group=0");
}
else
{
    header("location:index.php?false=1");
}