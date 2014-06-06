<article>  
    <?php
    if (isset($this->msg)) {
        echo "<span>" . $this->msg . "</span>";
    }
    ?>
    <h1>Управление категориями</h1>
    <br />    
    <table class='category_management' cellpadding="5" width="100%">
        <tr>
            <th width="100%">Имя категории</th>
            <th colspan="4">Действия</th>
        </tr>
        <? foreach ($this->category as $c) { ?>
            <tr>
                <td>
                    <?= str_repeat('&nbsp;', 6 * $c['category_level']) . '<strong><a href="/admin/category/view/' .$c['category_id'].'">' . $c['category_name'] ?></a></strong> [<strong><?= $c['category_left'] ?></strong>, <strong><?= $c['category_right'] ?></strong>, <strong><?= $c['category_level'] ?></strong>]
                </td>
                <td>
                    <a title='Добавить' href="/admin/category/add/<?= $c['category_id'] ?>"><img src='/public/images/add.png'></a>
                </td>
                <td>
                    <a title="Изменить" href="/admin/category/edit/<?= $c['category_id'] ?>"><img src='/public/images/edit.png'></a>
                </td>
                <td>

                    <?php
                    if (0 == $c['category_level']) {
                        echo '----';
                    } else {
                        ?>
                        <a title='Удалить' href="/admin/category/del/<?= $c['category_id'] ?>"><img src='/public/images/del.png'></a>
                        <?php
                    }
                    ?>

                </td>
                <td>

                    <?php
                    if (0 == $c['category_level']) {
                        echo '----';
                    } else {
                        ?>
                        <a title='Переместить' href="/admin/category/move/<?= $c['category_id'] ?>"><img src='/public/images/move.png'></a>
                        <?php
                    }
                    ?>

                </td>
            </tr>
    <?php
}
?>
    </table>
</article>

