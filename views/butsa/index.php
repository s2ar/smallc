<script src="/public/js/butsa.js"></script>
<!--<script src="/public/js/jquery.tablesorter.min.js"></script>-->
<div class="butsa_cont">
<?php echo $this->msg;?>
<h2>Butsa</h2>
<div><a href="/butsa/training">Тренировка</a></div><br />
<div><a href="/butsa/model">Моделирование игрока</a></div><br />
ID игрока 
<input type="text" name="player_id" value="" id="b_player_id"> 
<a id="b_send_id" class="cp">Загрузить</a> 
<div id="b_player_info"></div>
<div><a id="b_team_update" href="#">Обновить</a></div>
<h2>Команда</h2>
<div id="team">
<?php echo $this->html;?>
</div>
Расчет навыка <a id="b_calc_skill" class="cp">Посчитать</a>
<div id="resultSkill"></div>

Расчет мастерства игрока 
<input name="id_player" value="441789" id="b_player_id_calc" >&nbsp;&nbsp;
№ тренировка
<input name="tren" value="" id="b_tren" >

<a id="b_calc_mas" class="cp">Посчитать</a>
<div id="resultMas"></div>
</div>