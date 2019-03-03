<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Gdeal  修改图片</title>
</head>
<body>
    <h1>编辑图片:</h1>
    <form action="savepic.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="ids" value = "<?php echo $_GET['ids']; ?>"/>
        <label for="file">上传图片</label>
        <input type="file" name="upload"/>
        <br/>
        <input type="submit" value="提交" />
    </form>
</body>
</html>