<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gdeal</title>
</head>
<body>
<?php
session_start();
$uid=$_SESSION["uid"];

require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php';
date_default_timezone_set("PRC");

$query = $db->prepare('select account from login where username = :uid');
$query->bindValue(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$aye = $query->fetchAll(); 

// $aye[0][0];是余额

$incart =array();


$query = $db->prepare('select * from shopcart where user_id = :uid');
$query->bindValue(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$incart = $query->fetchAll(); //$incart是购物车里的东西的数组

$sum = 0;//总价
foreach($incart as $v)
{
    $query = $db->prepare('select price from items where ids = :ids');
    $query->bindValue(':ids',$v[2],PDO::PARAM_INT);
    $query->execute();
    $ajg = $query->fetchAll();  
    $dj = $ajg[0][0];//单价
    $sum +=$dj*$v[3];
    
}


//判断余额是否满足购买
if($aye[0][0]>=$sum)
{
    //余额满足,判断库存
    foreach($incart as $v)
    {

        $query = $db->prepare('select name,num from items where ids = :ids');
        $query->bindValue(':ids',$v[2],PDO::PARAM_INT);
        $query->execute();
        $akc = $query->fetchAll();  
        // $akc[0][1];//库存        

        //判库存是否满足
        if($akc[0][1]<$v[3])
        {
            echo"{$akc[0][0]}库存不足";
            echo "返回主页： "."<a href='main.php?group=0'>Gdeal主页</a>";
            exit;
        }
    
        
    }
    
    //提交订单
    //账户扣除余额
    
    
    $sql = "update login set account=account-{$sum} where username =:uid" ;  
    $query = $db->prepare($sql);
    $query->bindParam(':uid',$uid,PDO::PARAM_STR);
    $query->execute();

    //扣除库存
    foreach($incart as $v)
    {
        $sql = "update items set num = num-:pp where ids =:nn" ;  
        $query = $db->prepare($sql);
        $query->bindParam(':pp',$v[3],PDO::PARAM_INT);
        $query->bindParam(':nn',$v[2],PDO::PARAM_INT);
        $query->execute();
    }
    
    //添加订单
    $ddh = date("YmdHis");//返回一个字符串

    //添加订单详情
    foreach($incart as $v)
    {
        $sql = "insert into orders values('', :uid, :tid, :num, :time)";
        $query = $db->prepare($sql);
        $query->bindParam(':uid',$uid,PDO::PARAM_STR);
        $query->bindParam(':tid',$v[2],PDO::PARAM_INT);
        $query->bindParam(':num',$v[3],PDO::PARAM_INT);
        $query->bindParam(':time',$ddh,PDO::PARAM_STR);
        $query->execute();
        
    }
}
else
{
    echo"余额不足";
    echo "返回主页： "."<a href='../shopping/main.php?group=0'>Gdeal主页</a>";
    exit;
}
?>
</br>
<h1>恭喜您！完成购买！</h1>
<br>
<a href="../shopping/main.php?group=all">回到主页</a>
</body>
</html>