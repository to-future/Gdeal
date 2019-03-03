<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Gdeal</title>

  <link rel="stylesheet" href="../assets/css/normalize.css">

  <link rel="stylesheet" href="../assets/css/logonstyle.css" media="screen" type="text/css" />

</head>

<body>
    <div class="alarm">
        <?php
            $false = $_GET['false'];
            if ($false==1) {
                echo "该邮箱已经存在！请登录";
            }
            if ($false==2) {
                echo "两次输入不一致！请重新输入";    
            }
        ?>
    </div>
    <section class="login-form-wrap">
        <h1>成为Gdeal新用户</h1>
        <form class="login-form" action="logoncl.php" method="post">
            <label>
                <input type="email" name="uid" required placeholder="您的邮箱">
            </label>
            <label>
                <input type="text" name="nickname" maxlength="30" required placeholder="您的昵称">
            </label>
            
            <label>
                <input type="text" name="pwd" maxlength="30" required placeholder="设置密码">
            </label>
            <label>
                <input type="text" name="another" maxlength="30" required placeholder="确认密码">
            </label>
            <input type="submit" value="注册">
        </form>
    </section>
    <div style="text-align:center;clear:both">

</div>
</body>
</html>

</body>

</html>