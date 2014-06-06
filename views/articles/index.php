<article>    
    <?php    
    foreach ($this->msg as $article) {
        echo "<h2>".$article['title_article']."</h2>";
        echo "<p>".$article['content_article']."</p><hr />";    
    }
    
    ?>
    
</article>




