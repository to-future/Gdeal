<?php
    $newname = $_POST['newcataname'];

    require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php';
    $query = $db->prepare("insert into itemcata(Id,cataname) values('', :new)");
    $query->bindParam(':new', $newname, PDO::PARAM_STR);
    $query->execute();
    header('location:../items/main.php');
?>