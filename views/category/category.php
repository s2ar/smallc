<article>    
    <h2><?php echo $this->category; ?></h2>
    <? if ($this->articles != NULL): ?>     
        <ul>
            <?php foreach ($this->articles as $a): ?>           
                <li><a href='<?php echo URL; ?>articles/view/<?= $a['article_alias'] ?>'><?= $a['article_title'] ?></a></li> 
            <? endforeach; ?>
        </ul>
    <? endif; ?>
    <div id='articles'>
    </div>
</article>