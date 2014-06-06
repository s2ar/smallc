<div class ="category_edit">
    <?if($this->category_name!=NULL):?>
    <form action="/admin/category/edit/<?= $this->category_id ?>" method="POST">
        Имя категории: <input type="text" size='45' name="category[category_name]" value="<?=$this->category_name?>">
        <input type="submit" name="submit" value="изменить">
        <input type="hidden" value="1" name="edit">
    </form>
    <?else:?>
    Категория не найдена
    <?endif;?>
</div>