<article>
    <?php
    if (isset($this->msg)) {
        echo "<span>" . $this->msg . "</span>";
    }
//var_dump($this->article["article_alias"]);
    ?>
    <h1>Форма редактирования статьи</h1>
    <form action="<?php echo URL_ADMIN; ?>articles/edit/<?php echo $this->article['article_id']; ?>" method="post" >
        <p>Категория</p>
        <select name="article_cat">
            <? foreach ($this->tree as $c): ?> 
                <option <?php echo $c['category_id'] == $this->article['article_cat'] ? 'selected' : '' ?> value="<?= $c['category_id'] ?>"><?= str_repeat('&nbsp;', 6 * $c['category_level']) ?><?= $c['category_name'] ?><?php echo $c['category_id'] == $this->article['article_cat'] ? '<<<' : '' ?></option>
            <? endforeach; ?>
        </select>
        <p>Заголовок</p>
        <input size='60' type="text" name="article_title" value="<?php echo $this->article['article_title']; ?>"><br><br>
        <p>Содержание</p>
        <textarea class="ckeditor" name="article_content" ><?php echo $this->article['article_content']; ?></textarea><br><br>
        <p>Alias</p>
        <input type="text" name="article_alias" value="<?php echo $this->article["article_alias"]; ?>"><br><br>
        <input type="submit">
        <input type="hidden" value="1" name="edit">
        <input type="hidden" value="<?php echo $this->article['article_id']; ?>" name="article_id">
    </form>
</article>