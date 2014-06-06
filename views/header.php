<!DOCTYPE html>
<html>
    <head>
        <title>SmallC.</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="/public/css/default.css" type="text/css">
        <script src="/public/js/jquery_161.js"></script>
        <script src="/public/js/custom.js"></script>
        <script src="/public/js/obf.fullajax.js"></script>
    
    </head>
    <body>
        <?php Session::init(); ?>
        <div id="container">
            <header>
                <span id="site_name">SmallC.</span> 
                <br />
                <br />
                <a href="/index.php">Главная</a>
                <!--
                <a href="/articles">Статьи</a>
                -->
                <?php if (Session::get('loggedIn') === true): ?>
                    <a href="/butsa">Бутса</a>
                    <a href="/admin">Админка</a>
                    <a href="/login/logout">Выйти</a>
                <?php else: ?>
                    <a href="/login">Войти</a>
                <?php endif; ?>
            </header>            
            <?          
            $posURL = stripos($_SERVER["REDIRECT_URL"], '/butsa');  
            if($posURL === false){
        
            ?>
            <nav>             
        
                <div id="multi-derevo">
                <?
                foreach ($this->tree as $c) {
                    if (empty($curLevel)) {
                        echo "<ul>\n<li><span><a class='link_page' href='/category/view/".$c['category_id']."'>" . $c['category_name'] . "</a></span>\n";
                        $curLevel = $c['category_level'];
                        continue;
                    }
                    $r = $curLevel - $c['category_level'];
                    if ($r == 0) {
                        echo "</li>";
                        echo "<li><span><a class='link_page' href='/category/view/".$c['category_id']."'>" . $c['category_name'] . "</a></span>\n";
                        $curLevel = $c['category_level']; //    
                        continue;
                    } elseif ($r < 0) {
                        echo "<ul>\n";
                        echo "<li><span><a class='link_page' href='/category/view/".$c['category_id']."'>" . $c['category_name'] . "</a></span>\n";
                        $curLevel = $c['category_level'];
                        continue;
                    } else {
                        $r = abs($r);
                        echo "</li>\n";
                        for ($i = 1; $i <= $r; $i++) {
                            echo "</ul>\n";
                            echo "</li>\n";
                        }
                        echo "<li><span><a class='link_page' href='/category/view/".$c['category_id']."'>" . $c['category_name'] . "</a></span>\n";
                        $curLevel = $c['category_level'];
                    }
                }
                echo "</li>\n";
                for ($i = 1; $i <= $curLevel; $i++) {
                    echo "</ul>\n";
                    echo "</li>\n";
                }
                echo "</ul>\n";
                ?>
                </div>
            </nav>
            <div id="main">
          <?}else{?>
            <div id="main_all">   
          <?}?>
