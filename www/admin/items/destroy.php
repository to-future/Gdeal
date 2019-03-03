<?php 

    require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'].'/inc/common.php'; 
$sql = 	"delete from items where ids = :ids" ;	
$query = $db->prepare($sql);
$query->bindValue(':ids',$_POST['ids'],PDO::PARAM_INT);

if (!$query->execute()) {	
	print_r($query->errorInfo());
}else{
	redirect_to("main.php?group=all");
};

?>