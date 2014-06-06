<!DOCTYPE html>
<html>
 <head>
    <title>SmallC. .:. Administration panel</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="/public/css/admin.css" type="text/css">
    <script src="/public/js/jquery_161.js"></script>  
    <script type="text/javascript" src="/libs/ckeditor/ckeditor.js"></script>
 </head>
 <body>
     <?php Session::init(); ?>
<div id="container">
<header>
    <span>SmallC.</span>  
    <p>Administration panel</p>
</header>
<nav>
    <ul>
        <li><a href="/admin/index">Главная</a></li>
        <li><a href="/admin/articles">Управление статьями</a></li>
        <li><a href="/admin/category">Управление категориями</a></li>
            <?php if (Session::get('loggedIn')=== true): ?>
        <li><a href="/admin/login/logout">Выйти</a></li>
            <?php else:?>
        <li><a href="/admin/login">Войти</a></li>
           <?php endif;?>
        <br>
        <br>
        <li><a href="/index">Front-end</a></li>
    </ul>
</nav>    
  

