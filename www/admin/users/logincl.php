<?php

$uid =$_POST["uid"];
$pwd = $_POST["pwd"];


    require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php';  
    $query = $db->prepare('select * from governor where gname = :uid');
    $query->bindValue(':uid',$uid,PDO::PARAM_STR);
    $query->execute();
    $arr = $query->fetchObject();   



if($arr->gpassword==$pwd && !empty($pwd))
{    
    header("location:../items/main.php?group=all");
}
else
{
    echo"failed";
}