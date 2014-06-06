<?php // var_dump($this->team);?>
<script src="/public/js/jquery.tablesorter.min.js"></script>
<script>
    $(document).ready(function(){  
        $("#tableTeam").tablesorter(); 
    })
</script>
<table id="tableTeam" style="width: 100%;" cellspacing="0">
    <thead>
    <tr>
        <th align="center">№</th>
        <th align="center">Имя</th>
        <th align="center">Трен/нав</th>
        <th align="center">Масса</th>
        <th align="center">Возр</th>
        <th align="center">Поз</th>
        <th align="center">Отбор</th>
        <th align="center">Опека</th>
        <th align="center">Дриблинг</th>
        <th align="center">Пр. мяча</th>
        <th align="center">Вын</th>
        <th align="center">Пас</th>
        <th align="center">Сила уд.</th>
        <th align="center">Точность уд.</th>        

        <th align="center">Тал</th>
        <th align="center">Р/Тал</th>
        <th align="center">Тип</th>
        
    </tr>
    </thead>
    <tbody>
<?php 
$i=1;
foreach ($this->team as $p) {?>

<tr>
    <td><?=$i?></td>
    <td><a href='http://www.butsa.ru/xml/players/info.php?id=<?=$p['id_player']?>'><?=$p['name']?></a></td>
    <td align="center"><?=$p['tren']?></td>
    <td align="center"><?=$p['mas']?></td>
    <td align="center"><?=$p['age']?></td>
    <td align="center"><?=$p['pos']?></td>
    <td align="center"><?=$p['ot']?></td>
    <td align="center"><?=$p['op']?></td>
    <td align="center"><?=$p['dr']?></td>
    <td align="center"><?=$p['pm']?></td>
    <td align="center"><?=$p['vn']?></td>
    <td align="center"><?=$p['ps']?></td>
    <td align="center"><?=$p['sl']?></td>
    <td align="center"><?=$p['tch']?></td>    
    <td align="center"><?=$p['tal']?></td>
    <td align="center"><?=$p['rtal']?></td>
    <td align="center"><?=$p['type']?></td>
    
</tr>  


<?
    $mass[]=$p['mas'];    
    $i++;
}
rsort($mass);
for ($i = 0; $i < 11; $i++) {
    $sumMass = $sumMass + $mass[$i];
}
$avgMass11 = $sumMass/11;
?>
</tbody>
</table> 
<div>Сила 11 лучших:  <b><?=round($avgMass11, 1)?> (<?=round($sumMass,0)?>)</b></div>
