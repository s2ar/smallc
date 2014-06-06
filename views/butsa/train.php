<?php // var_dump($this->team);?> 
<form target="_blank" action="http://www.butsa.ru/xml/players/train.php?type=players/train&act=select" enctype="multipart/form-data" method="post" name="select">
<input type="hidden" value="1" name="step">
<input type="hidden" value="players/train" name="type">
<input type="hidden" value="/xml/players/train.php?" name="firstpage">
<input type="hidden" value="select" name="act">
<input id="numrows" type="hidden" value="23" name="numrows">
<table id="tableTeam" style="width: 100%;" cellspacing="0">
    <thead>
    <tr>
        <th align="center">№</th>
        <th align="center">Имя</th>
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
        <th align="center">Трен/нав</th>
        <th align="center">Умения</th>
    </tr>
    </thead>
    <tbody>
<?php
$i=0;
$skills =array(
    "ot"=>array('1','Отбор'),
    "op"=>array('2','Опека'),
    "dr"=>array('3','Дриблинг'),
    "pm"=>array('4','Прием мяча'),
    "vn"=>array('5','Выносливость'),
    "ps"=>array('6','Пас'),
    "sl"=>array('7','Сила удара'),
    "tch"=>array('8','Точность удара'),
);

foreach ($this->team as $p) {?>

<tr>
    <td><?=$i?></td>
    <td><a href='http://www.butsa.ru/xml/players/info.php?id=<?=$p['id_player']?>'><?=$p['name']?></a></td>
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
    <td align="center"><?=$p['tren']?></td>
    <td align="center">
        <?if($p['pos']!='Gk'){?>
        <input type="hidden" value="<?=$p['id_player']?>" name="PlayerID[<?=$i?>]">
        <input size="2/" value="100" name="PercentTrain[<?=$i?>]">
        <select name="AbilityID[]" style="width: 120px">
            <option value="<?=$skills[$p['tren']][0]?>"><?=$skills[$p['tren']][1]?></option>
        </select>
        <?}else{?>
        <input type="hidden" value="<?=$p['id_player']?>" name="PlayerID[<?=$i?>]">
        <input size="2/" value="100" name="PercentTrain[<?=$i?>]">
        <input name="AbilityID[<?=$i?>]" type="hidden" value=""/>
 
        
        <?}?>
        
    </td>
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
<input type="hidden" value="select" name="oldact">
<input class="button" type="submit"  value="Сохранить настройки">
<div>Сила 11 лучших:  <b><?=round($avgMass11, 1)?> (<?=round($sumMass,0)?>)</b></div>
