<?php
    session_start();
    $addmoney = $_POST['money'];
    if ($addmoney<0) {
        header("location:show.php");
    }else{
        require_once "../inc/db.php";
        $query = $db->prepare("update login set account = account+:add where UserName = :id");
        $query->bindParam(':add', $_POST['money'], PDO::PARAM_INT);
        $query->bindParam(':id', $_POST['userid'], PDO::PARAM_STR);
        if (!$query->execute()) {
            print_r($query->errorinfo);
        }else{
            header("location:show.php");
        }
    }
?>