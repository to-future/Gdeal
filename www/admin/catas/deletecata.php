<?php
    $dels = $_POST['deletecata'];

    require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php';
    $num = count($dels);
    for ($i=0; $i<$num; $i++){
        $query = $db->prepare("delete from itemcata where Id =:did");
        $query->bindParam(':did', $dels[$i], PDO::PARAM_INT);
        $query->execute();
    }
    header('location:../items/main.php');
?>