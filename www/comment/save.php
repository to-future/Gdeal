<?php 

require_once '../inc/db.php';

$sql = "insert into comment(cid,uid,itemid,body) values('', :uid, :itemid,:body);" ;  
$query = $db->prepare($sql);
$query->bindParam(':uid',$_POST['userid'],PDO::PARAM_STR);
$query->bindParam(':itemid',$_POST['itemid'],PDO::PARAM_INT);
$query->bindParam(':body',$_POST['cbody'],PDO::PARAM_STR);

if (!$query->execute()) { 
  print_r($query->errorInfo());
}else{
    header("location:../shopping/detail.php?ids=" . $_POST['itemid']); 
};

?>