<!DOCTYPE html>
<html>
 <head>
    <title>smallC</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/admin.css" type="text/css">   
 </head>
 <body>
<div id='auth'>
   
    <h2>Авторизация</h2>
        <form action="<?php echo URL_ADMIN; ?>login/run" method="post">

            <label>Логин</label>&nbsp;&nbsp;&nbsp;<input type="text" name="login" /><br /><br />
            <label>Пароль</label>&nbsp;&nbsp;<input type="password" name="password" /><br /><br />
            <label></label>&nbsp;&nbsp;&nbsp;<input class ="auth_input" type="submit" />    

        </form>
   
</div>    
</body>
</html>