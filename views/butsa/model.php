<?php // var_dump($this->team);?> 
<script src="/public/js/butsa.js"></script>
<h2>Моделирование игрока</h2>
<select name="player" id="id_player">
    <?foreach($this->team as $p):?>
    <option value="<?=$p['id_player']?>"><?=$p['name']?></option>       
     <?endforeach;?>          
</select><br /><br />
Начать с тренировки:
<input id="start_tren" name="start_tren" value="1"><br /><br />
Количество тренировок:
<input id="num_tren" name="num_tren" value="10"><br /><br />
<a href="#" id="calc_mass1" >Расчитать </a><br />

<div id="resultMas"></div>
<!-- Моделирование команды -->
<h2>Моделирование команды</h2>
Начать с тренировки:
<input id="start_tren_team" name="start_tren_team" value="1"><br /><br />
Количество тренировок:
<input id="num_tren_team" name="num_tren_team" value="126"><br /><br />
<a href="#" id="calc_team" >Расчитать </a><br />
<div id="resultTeam"></div>
