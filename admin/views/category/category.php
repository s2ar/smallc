<article>    
    <h2><?php echo $this->category; ?></h2>
    <?if($this->articles!=NULL):?>
    <table class='category_management' cellpadding="3" width="100%">
        <tr>
            <th width="100%">Статьи категории</th>
            <th colspan="2">Действия</th>
        </tr>
        <?php foreach ($this->articles as $a): ?> 
            <tr> 
                <td><a href='/admin/articles/view/<?= $a['article_id'] ?>'><?= $a['article_title'] ?></a></td> 
                <td><a href='/admin/articles/edit/<?= $a['article_id'] ?>'><img src='/public/images/edit.png'></a></td>
                <td><a href='/admin/articles/del/<?= $a['article_id'] ?>'><img src='/public/images/del.png'></a></td>
            </tr>
        <? endforeach; ?>
    </table>
    <?  endif;?>
</article>