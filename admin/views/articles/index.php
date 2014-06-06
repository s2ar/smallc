<article>  
    <?php if(isset($this->msg)){
    echo "<span>".$this->msg."</span>";
    } 
    ?>
    <h1>Управление статьями</h1>
    <br />
    <a href="<?php echo URL_ADMIN; ?>articles/add">Добавить статью</a><br/><br/>
    <table class='category_management' cellpadding="3" width="100%">
        <tr>
            <th width="100%">Имя статьи</th>
            <th colspan="2">Действия</th>
        </tr>
        
    <?php  
    foreach ($this->articles as $a): ?> 
       <tr> 
       <td><a href='<?php echo URL_ADMIN; ?>articles/view/<?=$a['article_id']?>'><?=$a['article_title']?></a></td> 
       <td><a href='<?php echo URL_ADMIN; ?>articles/edit/<?=$a['article_id']?>'><img src='<?php echo URL; ?>public/images/edit.png'></a></td>
       <td><a href='<?php echo URL_ADMIN; ?>articles/del/<?=$a['article_id']?>'><img src='<?php echo URL; ?>public/images/del.png'></a></td>
       </tr>
     <?endforeach;?>
    </table>
</article>

