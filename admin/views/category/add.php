<div class ="category_add">
    <?if($this->category_id!=NULL):?>
    <form action="/admin/category/add/<?= $this->category_id ?>" method="POST">
        Имя категории: <input type="text" size='45' name="category[category_name]" value="">
        <input type="submit" name="submit" value="создать">
        <input type="hidden" value="1" name="add">
    </form>
    <?else:?>
    Неверно задана родительская категория
    <?endif;?>
</div>