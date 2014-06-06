<div class ="category_move">
    <table cellpadding="5" align="center">
        <tr>
            <th>
                Перемещение категории
            </th>
        </tr>
        <tr>
            <td>
                <form action="/admin/category/move/<?= $this->category_id ?>" method="POST">
                    <strong>1) Перемещение категории на своем уровне со своими дочерними категориями.</strong><br>
                    Выбор категории относительно которой происходит перемещение:
           
                    <select name="category2_id">
                        <? foreach ($this->dataForm[0] as $c): ?> 
                            <option value="<?= $c['category_id'] ?>"><?= $c['category_name'] ?> <?php echo $c['category_id'] == $this->category_id ? '<<<' : '' ?></option>
                        <? endforeach; ?>  
                    </select><br>
                    Выбор позиции:
                    <select name="position">
                        <option value="after">После</option>
                        <option value="before">До</option>
                    </select><br>
                    <input type="hidden" value="1" name="move">
                    <center><input type="submit" value="Переместить"></center><br>
                </form>
                <form action="/admin/category/move/<?= $this->category_id ?>" method="POST">
                    <strong>2) Назначить другую категорию в качестве родительской, перемещается полностью ветка (сохраняются дочерние категории).</strong><br>
                    Изменить родительскую категорию на:
                    <select name="category2_id">
                        <? foreach ($this->dataForm[1] as $c): ?> 
                            <option value="<?= $c['category_id'] ?>"><?= str_repeat('&nbsp;', 6 * $c['category_level']) ?><?= $c['category_name'] ?> <?php echo $c['category_id'] == $this->category_id ? '<<<' : '' ?></option>
                        <? endforeach; ?>
                    </select><br>
                    <input type="hidden" value="2" name="move">
                    <center><input type="submit" value="Переместить"></center><br>
                </form>
            </td>
        </tr>
    </table>
</div>