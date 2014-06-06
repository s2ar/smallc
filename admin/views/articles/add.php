<article>
    <h1>Форма добавления статьи</h1>
    <form action="<?php echo URL_ADMIN; ?>articles/add/" method="post" >
        <p>Категория</p>
        <select name="article_cat">
            <? foreach ($this->tree as $c): ?> 
                <option value="<?= $c['category_id'] ?>"><?= str_repeat('&nbsp;', 6 * $c['category_level']) ?><?= $c['category_name'] ?></option>
            <? endforeach; ?>
        </select>
        <p>Заголовок</p>
        <input size='60' type="text" name="article_title" value=""><br><br>
        <p>Содержание</p>
        <textarea name="article_content" class="ckeditor" ></textarea><br><br>
        <p>Alias</p>
        <input type="text" name="article_alias" value=""><br><br>
        <input type="submit" value="Сохранить">
        <input type="hidden" value="1" name="add">

    </form>
</article>