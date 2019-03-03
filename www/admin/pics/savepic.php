<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gdeal修改</title>
</head>

<body>
<?php
print_r($_FILES);
// 获取文件名,若为中文文件，由于客户端与服务端的编码不一致的问题，会有乱码
$file = strtolower($_FILES['upload']['name']);

// 重新对上传文件命名，规避乱码问题，避免文件名唯一性冲突
$path_parts = pathinfo( $_FILES['upload']['name'] );
$ext = $path_parts['extension'];
$file = 'item' . mt_rand() . '.' . $ext;

//获取已上传的文件
$tmp_file_path = $_FILES['upload']['tmp_name'];


//设置文件上传被保存到的目录与名字，注意包含'/'
//注意处理上传文件名与服务器现有文件名存在冲突时
$dest_dir = $_SERVER['DOCUMENT_ROOT']."/assets/img/";
$dest_file_path = $dest_dir . $file;



//判断文件是否已成功通过http post方式上传到临时目录
//判断文件是否能正确的从临时目录移动到指定目录,linux下失败的原因一般为对指定目录无读写权限
if( !is_uploaded_file($tmp_file_path) || !move_uploaded_file($tmp_file_path,$dest_file_path) ){
    set_notice("文件上传失败！请联系站点管理员！");
    redirect_to("./");
    exit();
}else{
    
    require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'].'/inc/common.php'; 

    $ids = $_POST['ids'];

    $chitem = "update items set image = :image where ids= :ids;";
    $query = $db->prepare($chitem);
    $query->bindParam(':ids',$ids,PDO::PARAM_INT);
    $query->bindParam(':image',$file,PDO::PARAM_STR);

    if (!$query->execute()) {   
        print_r($query->errorInfo());
    }else{
        redirect_to("main.php?group=all");
    }

}


?>

</body>
</html>