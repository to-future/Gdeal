<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>

</body>
</html>
<?php
    $uid = $_GET['uid'];
    require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php';  
    $query = $db->prepare('select * from login where UserName = :uid');
    $query->bindValue(':uid',$uid,PDO::PARAM_STR);
    $query->execute();
    $man = $query->fetchObject();
?>

<form action="update.php", method="post">
    <input type="text" name="name" value="<?php echo $man->Name;?>">
    <input type="number" name="account" value="<?php echo $man->Account;?>">
    <input type="hidden" name="uid" value="<?php echo $man->UserName;?>">
    <input type="submit" value="提交">
</form>