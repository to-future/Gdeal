<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gdeal修改</title>
</head>

<body>
<?php 

    require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'].'/inc/common.php'; 

$ids = $_POST['ids'];

$chitem = "update items set name = :name,price = :price,itemcata = :itemcata,cata = :cata,num = :num,body = :body where ids= :ids;";

$query = $db->prepare($chitem);
$query->bindParam(':ids',$_POST['ids'],PDO::PARAM_INT);
$query->bindParam(':name',$_POST['name'],PDO::PARAM_STR);
$query->bindParam(':price',$_POST['price'],PDO::PARAM_STR);
$query->bindParam(':itemcata',$_POST['itemcata'],PDO::PARAM_STR);
$query->bindParam(':cata',$_POST['cata'],PDO::PARAM_STR);
$query->bindParam(':num',$_POST['num'],PDO::PARAM_INT);
$query->bindParam(':body',$_POST['body'],PDO::PARAM_STR);

if (!$query->execute()) {   
    print_r($query->errorInfo());
}else{
    redirect_to("main.php?group=all");
};

?>

</body>
</html>