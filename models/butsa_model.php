<?php

class Butsa_Model extends Model {
    public $nagrTren; // нагрузка тренировки
    public $trener; // уровень тренера
    public $baza; // уровень базы
    
    public $profile;
    public $setSkill;
    
    private $useragent = "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:15.0) Gecko/20100101 Firefox/15.0.1";


    function __construct() {
        parent::__construct();
        include($_SERVER['DOCUMENT_ROOT'].'/libs/simple_html_dom.php');
        $this->nagrTren = 100;
        $this->trener = 3;
        $this->baza = 3;
        /**
         * Навыки защитника
         * :общее 35
         * :ot  5 (0.143)
         * :op  5 (0.143)
         * :pm  4 (0.114)
         * :dr  4 (0.114)
         * :vn  4 (0.114)
         * :ps  5 (0.143)
         * :sl  4 (0.114)
         * :tch 4 (0.114)
         */
        $this->profile['Ld']=$this->profile['Rd']=$this->profile['Cd']=array('ot','op');
        /**
         * Навыки флангового полузащитника
         * :общее 35
         * :ot  4 (0.114)
         * :op  4 (0.114)
         * :pm  5 (0.143)
         * :dr  5 (0.143)
         * :vn  4 (0.114)
         * :ps  5 (0.143)
         * :sl  4 (0.114)
         * :tch 4 (0.114)
         */        
        $this->profile['Lm']=$this->profile['Rm']=array('dr','pm','ps');
        /**
         * Навыки цн полузащитника
         * :общее 35
         * :ot  4 (0.114)
         * :op  4 (0.114)
         * :pm  5 (0.143)
         * :dr  5 (0.143)
         * :vn  4 (0.114)
         * :ps  5 (0.143)
         * :sl  4 (0.114)
         * :tch 4 (0.114)
         */           
        
        $this->profile['Cm']=array('ps','pm');
        /**
         * Навыки крайнего нападающего
         * :общее 37
         * :ot  4 (0.108)
         * :op  4 (0.108)
         * :pm  5 (0.135)
         * :dr  5 (0.135)
         * :vn  4 (0.108)
         * :ps  5 (0.135)
         * :sl  5 (0.135)
         * :tch 5 (0.135)
         */
        
        $this->profile['Lf']=$this->profile['Rf']=array('dr','sl','tch');
        /**
         * Навыки цн нападающего
         * :общее 36
         * :ot  4 (0.111)
         * :op  4 (0.111)
         * :pm  5 (0.139)
         * :dr  5 (0.139)
         * :vn  4 (0.111)
         * :ps  4 (0.111)
         * :sl  5 (0.139)
         * :tch 5 (0.139)
         */
        $this->profile['Cf']=array('sl','tch');
      
        // Макс. значения навыков (таблица прокачки)
        $this->setSkill['Ld']=$this->setSkill['Rd']=$this->setSkill['Cd']=array(
            'ot' =>0.143,
            'op' =>0.143,
            'pm' =>0.114,
            'dr' =>0.114,            
            'vn' =>0.114,
            'ps' =>0.143,
            'sl' =>0.114,
            'tch'=>0.114
        );
        $this->setSkill['Lm']=$this->setSkill['Rm']=array(
            'ot' =>0.114,
            'op' =>0.114,
            'pm' =>0.143,
            'dr' =>0.143,            
            'vn' =>0.114,
            'ps' =>0.143,
            'sl' =>0.114,
            'tch'=>0.114
        );
        $this->setSkill['Cm']=array(
            'ot' =>0.114,
            'op' =>0.114,
            'pm' =>0.143,
            'dr' =>0.143,            
            'vn' =>0.114,
            'ps' =>0.143,
            'sl' =>0.114,
            'tch'=>0.114
        );
       $this->setSkill['Lf']=$this->setSkill['Rf']=array(
            'ot' =>0.108,
            'op' =>0.108,
            'pm' =>0.135,
            'dr' =>0.135,            
            'vn' =>0.108,
            'ps' =>0.135,
            'sl' =>0.135,
            'tch'=>0.135
        );
        $this->setSkill['Cf']=array(
            'ot' =>0.111,
            'op' =>0.111,
            'pm' =>0.139,
            'dr' =>0.139,            
            'vn' =>0.111,
            'ps' =>0.111,
            'sl' =>0.139,
            'tch'=>0.139
        );
    }

    function pumpingPlayer($skills, $start_tren, $num_tren) {
    /*-- метод запускает цикл прокачки игрока. 
     * входящие параметры
     * @skills - масив значений навыков  
     * @tren - номер тренировки
     */ 
        $newArr=array();
        for ($i = $start_tren; $i < $num_tren+$start_tren; $i++) {             
            // Если тренировка 127 т.е первая тренировка след сезона
            // Прибавляем год            
            
            if($flagNewSeason){
                $skills['age'] = $skills['age']+ 1;
                $flagNewSeason = false;
            }
            if(($i % 126)== 0)  $flagNewSeason = true;   
            $curKey = $this->determineSkill($skills);
//            var_dump($curKey);
            $valSkill = $this->calcSkill($skills, $skills[$curKey]); 
//            var_dump($valSkill);
            $skills[$curKey] = $skills[$curKey] + $valSkill;   
//            var_dump($skills[$curKey]);
            $newArr[][$curKey]=$skills[$curKey];   
            $skills = $this->agingPlayer($skills); // Старение            
        }       
        $skills['mas']=  $this->getMass($skills);   
                    
        if($skills['age']>35) return false;
        return $skills;
    }
    
    function pumpingTeam($team=1, $start_tren=1, $num_tren=126) {
        /* Метод моделирует процесс развитие команды. Моделирует прокачку каждого игрока.
         * Входящие параметры 
         * $team = Номер "варианта команды" пока всегда 1 
         * $start_tren - номер начало тренировки
         * $num_tren - количество тренировок
         */
        $teamCurrent = $this->getTeam($team);
        foreach ($teamCurrent as $player) {            
//           var_dump($player); 
           if($player['age']>35) continue; 
//            var_dump($player); 
            $tmp = $this->pumpingPlayer($player, $start_tren, $num_tren);
            if($tmp) $teamFuture[]=$tmp;            
        }        
//        var_dump($teamFuture);        
        return $teamFuture;
        
    }
    
    function agingPlayer($player) {
        /*
         * Метод проверяет возраст.
         * Если игрок в возрасте то рандомный навык уменьшается по такой схеме
         * 5.3. При достижении полевыми игроками возраста 30 лет, они начинают терять по 0,03 балла мастерства 
         * после каждой тренировки, не зависимо от нагрузки. При дальнейшем старении игрока происходит увеличение 
         * потерь мастерства - на 0,015 в год, т.е.: в 31 год потеря мастерства после каждой тренировки 
         * составит 0,045 балла; в 32 года – 0,060; в 33 года – 0,075 и так далее.
         * 5.4. У вратарей потеря в мастерстве начинается с 31 года, и выглядит так: 
         * в 31 год – 0,030; в 32 года – 0,045; в 33 года – 0,060 и так далее.
         */
        $skills = array('ot', 'op' , 'dr', 'pm', 'vn', 'ps', 'sl', 'tch');
        // выберим случайный скил
        if($player['age']>=30){
            if($player['pos']=='Gk' AND $player['age']>=31){
                // Расчет варатарей
                $player['mas'] = $player['mas'] - (($player['age']-31)*0.015 + 0.03);
            }elseif($player['pos']!='Gk'){
                // Расчет полевых игроков                
                $indexSkill = rand(0, 7);          
                $player[$skills[$indexSkill]] = $player[$skills[$indexSkill]] - (($player['age']-30)*0.015 + 0.03);         
            }            
        }
       return $player;
      
    }
        
    function getMass($param) {
        /*
         * Метод расчитывает массу игрока
         * 
         */
        if($param['pos']=='Gk') return $param['mas'];
        $mass = $param['ot']+$param['op']+$param['pm']+$param['dr']+$param['vn']+$param['ps']+$param['sl']+$param['tch'];
        return $mass;
        
    }
    
    /**
     * Метод определяет по критериям (возраст, позиция и т.д )какой навык качать
     * Проф навыков не больше 3-х
     * Алгоритм такой:
     * 1) Качаем выносливость до 18
     * 2) Качаем профили до 21
     * 3) Если <=26 качаем по пропорции
     * 4) Если >26 качаем минималку
     * 
     * возвращает код навыка - например 'dr' - дриблинг
     * @param array $param
     * @return string код навыка
     */
    function determineSkill($param) {
        // Определяем позицию игрока (совмещение не учитывается)
        $pos_tmp = explode("/", $param['pos']);
        
        // Если указано флаг совмещения 1, тренируем исходя совмещения
        if($param['combination']==1){
            $pos = $pos_tmp[1]; 
        }else{
            $pos = $pos_tmp[0];
        }
            
        if($pos=='Gk') return "mas";
        
        $age = $param['age']; 
        $skills = array(
            'ot' =>$param['ot'],
            'op' =>$param['op'],
            'pm' =>$param['pm'],
            'dr' =>$param['dr'],            
            'vn' =>$param['vn'],
            'ps' =>$param['ps'],
            'sl' =>$param['sl'],
            'tch'=>$param['tch']
        );
        // Определим какой навык необходимо качать
        
        // Выносливость всегда должна быть не меньше 18
        if($param['vn']<18) return 'vn';
        
        // Создадим массив профильных навыков
        $prof=array();
        foreach ($this->profile[$pos] as $p) {
            $prof[$p]=$skills[$p];
        }
        asort($prof);
        reset($prof);
        
        // Получим минимальный проф. навык
        $el = each($prof);          

        // Если он меньше заданого лимита, качаем его
        if($el["value"]<21) return $el["key"];
        
        // При возрасте <=26 качаем по пропорции       
        if($age<=26){
            $prof=array();
            $sum=0;
            foreach ($skills as $key => $s) {               
                $prof[$key]=$s;
                $sum = $sum +$s;                
            }

            $profPer=array();
            // Найдем отклонение текущей пропорции от необходимой
            foreach ($prof as $key => $s) {
                $profPer[$key]=round($s/$sum,3) - $this->setSkill[$pos][$key];
            }
            asort($profPer);       
//            
//            var_dump($profPer);
//            var_dump($sum);            
            
            // максимальное отрицательное отклонение
            $el2 = each($profPer);   
            return $el2['key'];
            
        }else{
            // Игроки старше 26 лет качают минимальное умение
            asort($skills);
            reset($skills);
            $el3 = each($skills);  
            return $el3["key"];  
            
        }     
    }
    
    function updatePlayer($player_id) {
        if(!is_numeric($player_id)) return false;
        $url = 'http://www.butsa.ru/index.php?login=1';
        $username = 'corar';
        $userpass = 'pandemonium';
        // формируем строку с данными
        $postdata = "auth_name=".$username."&auth_pass=".$userpass."&auth_remember=true&step=1&url";
        $url = 'http://www.butsa.ru/xml/players/info.php?id='.$player_id;
        $result = $this->get_web_page($url);
        $html = str_get_html($result['content']);        
        $obj = $html->find('table table table table table table table table table table tr td b ');

        $j=1;
        foreach ($obj as $p) { 
            if($p->plaintext==NULL) return 'Не удалось подключиться к Бутсе!';
            if($j==4 && str_replace("_", "", $p->plaintext)=='Gk' ){
                $ptype = 'Gk';
                break;
            }
            $j++;
        }
    
        $arPlayerInfo=array();
        $i=1;
        
        if($ptype != 'Gk'){
            foreach($obj as $t) {
                switch ($i) {
                    case 1:
                        $arPlayerInfo['ot']=str_replace("_", "", $t->plaintext);
                        break;
                    case 2:
                        $arPlayerInfo['op']=str_replace("_", "", $t->plaintext);
                        break;
                    case 3:
                        $arPlayerInfo['dr']=str_replace("_", "", $t->plaintext);
                        break;
                    case 4:
                        $arPlayerInfo['pm']=str_replace("_", "", $t->plaintext);
                        break;
                    case 5:
                        $arPlayerInfo['vn']=str_replace("_", "", $t->plaintext);
                        break;
                    case 6:
                        $arPlayerInfo['ps']=str_replace("_", "", $t->plaintext);
                        break;
                    case 7:
                        $arPlayerInfo['sl']=str_replace("_", "", $t->plaintext);
                        break;
                    case 8:
                        $arPlayerInfo['tch']=str_replace("_", "", $t->plaintext);
                        break;
                    case 9:
                        $arPlayerInfo['mas']=str_replace("_", "", $t->plaintext);
                        break;
                    case 10:
                        $arPlayerInfo['age']=str_replace("_", "", $t->plaintext);
                        break;
                    case 11:
                        $arPlayerInfo['pos']=str_replace("_", "", $t->plaintext);
                        break;
                    case 21:
                        $arPlayerInfo['tal']=str_replace("_", "", $t->plaintext);
                        break;
                    case 24:
                        $arPlayerInfo['rtal']=str_replace("_", "", $t->plaintext);
                        break;

                    default:
                        break;
                }
                $i++;
            }
        }else{            
    
            $i=1;
            foreach($obj as $t) {
                switch ($i) {
                    case 1:
                        $arPlayerInfo['mas']=str_replace("_", "", $t->plaintext);
                        break;                 
                    case 3:
                        $arPlayerInfo['age']=str_replace("_", "", $t->plaintext);
                        break;                    
                    case 4:
                        $arPlayerInfo['pos']=str_replace("_", "", $t->plaintext);
                        break;
                    case 14:
                        $arPlayerInfo['tal']=str_replace("_", "", $t->plaintext);
                        break;
                    case 17:
                        $arPlayerInfo['rtal']=str_replace("_", "", $t->plaintext);
                        break;

                    default:
                        break;
                }
                $i++;
            }
            
            $arPlayerInfo['ot']='';                       
            $arPlayerInfo['op']='';                       
            $arPlayerInfo['dr']='';                       
            $arPlayerInfo['pm']='';                       
            $arPlayerInfo['vn']='';                      
            $arPlayerInfo['ps']='';                      
            $arPlayerInfo['sl']='';                       
            $arPlayerInfo['tch']='';                       
                              
            
        }    
        $arPlayerInfo['id_player'] = $player_id;
        foreach($html->find("a[href^=/xml/players/info.php?id=]") as $p){
            $tmpName[] = $p->plaintext;
        }
        $arPlayerInfo['name'] = $tmpName[1];
        $arPlayerInfo['type'] = 1;
        
        // Узнаем есть ли уже запись этого игрока
        $row = $this->db->selectRow('SELECT id FROM players WHERE id_player=?', $player_id);
        if(empty($row)) {
            $id = $this->addPlayer($arPlayerInfo);            
        }else{
            $id = $this->db->query('UPDATE players SET ?a WHERE id_player=?', $arPlayerInfo, $player_id);
        }
//        
        return $id;
    }
    
    function addPlayer($data) { 
        $id = $this->db->query('INSERT INTO players SET ?a', $data);   
        return $id;          
    }

    function getTeam($type, $tren=false) {
        /*Возвращает команду по типу*/
        $res = $this->db->select("SELECT * FROM players WHERE type =?d ORDER BY pos DESC ", $type);        
        foreach ($res as $row) {
            if($tren){                
//                $row['tren']=$this->determineSkill($this->getPlayer($row['id_player']));               
                $skill = $this->determineSkill($row);
                $row['tren']=$skill;
            }
            $team[]=$row;
        }        
        return  $team; 
    }
    
    function getPlayer($player_id) {
         $row = $this->db->selectRow('SELECT * FROM players WHERE id_player=?', $player_id);
         return $row;
    }
    
    function updateTeam() {
        /*обновляет основную команду*/
        $res = $this->db->select("SELECT id_player FROM players WHERE type =?d ORDER BY pos DESC ", 1);
        $players = array();
        foreach ($res as $row) { 
            if(!is_numeric($this->updatePlayer($row['id_player']))) return "Ошибка обновления данных";
        }  
               
        return $this->getTeam(1); 
    }
    
    function calcSkill($arPlayer, $skill) {

        $tal=$arPlayer['rtal'];
        $age = $arPlayer['age'];
        $mas= $arPlayer['mas'];
        if($arPlayer['pos']=='Gk'){
            $oldSkill= $skill/7.7;
        }else{ 
            $oldSkill= $skill;
        }
        $newSkill_1 = $this->nagrTren*(pow(($this->trener*$this->baza*0.13+pow($tal,0.6)*0.6),2));
        $newSkill_2 = round($newSkill_1/(19+pow($oldSkill, 2))/50*(1-  pow(abs($age-22.5),1.84)*0.013)*(1-  pow($mas, 0.6)*(0.019-$tal*0.001)),3);
        return $newSkill_2;
    }
    
    function cronTrain(){
        $team = $this->getTeam(1,true);
        // Подготовим данные для передачи
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

        
        $data ='';
        $data .="step='1'";
        $data .="&type='players/train'";
        $data .="&firstpage='/xml/players/train.php?'";
        $data .="&numrows='22'";
        
        $i=0;
        foreach ($team as $p) {   
            if($p['pos']!='Gk'){
                $data .="&PlayerID[".$i."]='".$p['id_player']."'";         
                $data .="&PercentTrain[".$i."]='100'";
                $data .="&AbilityID[]='".$skills[$p['tren']][0]."'";
            }else{
                $data .="&PlayerID[".$i."]='".$p['id_player']."'";
                $data .="&PercentTrain[".$i."]='100'";
                $data .="&AbilityID[".$i."]=''";
            }
            
            $i++;
        }
        $data .="&oldact='select'";
        
//        $data = array("ver"=>1);
        
        
        $username = 'corar';
        $userpass = 'pandemonium';
        // формируем строку с данными
        $postdata = "auth_name=".$username."&auth_pass=".$userpass."&auth_remember=true&step=1&url";
        if( $ch = curl_init() ) {            
            // Залогинемся
            curl_setopt($ch,CURLOPT_URL,'http://www.butsa.ru/index.php?login=1');
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
            curl_setopt($ch, CURLOPT_USERAGENT, $this->useragent);  // useragent
            curl_setopt($ch, CURLOPT_COOKIEJAR, "/libs/config/coo");
            curl_setopt($ch, CURLOPT_COOKIEFILE, "/libs/config/coo");
            $out = curl_exec($ch);
//            echo $out;
//            curl_setopt($ch,CURLOPT_URL,'http://www.butsa.ru/xml/players/info.php?id=329157');
//            curl_setopt($ch,CURLOPT_URL,'http://www.butsa.ru/xml/players/train.php?type=players/train&act=select');
            curl_setopt($ch,CURLOPT_URL,'http://www.butsa.ru/xml/players/train.php');
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//            curl_setopt($ch, CURLOPT_POST, 1);
//            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_USERAGENT, $this->useragent);  // useragent
//            curl_setopt($ch, CURLOPT_COOKIEJAR, "/libs/config/coo");
//            curl_setopt($ch, CURLOPT_COOKIEFILE, "/libs/config/coo");
            $out = curl_exec($ch);
            echo $out;
            curl_close($ch); 
                                   
        }
        // Отправим форму
        
        if( $ch = curl_init() ) {            
            // Залогинемся
                       
        }
        
        
        
        return "ок";
    }
    
    
    function get_web_page($url) {
     
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   // возвращает веб-страницу
        curl_setopt($ch, CURLOPT_HEADER, 0);           // не возвращает заголовки
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);   // переходит по редиректам
        curl_setopt($ch, CURLOPT_ENCODING, "");        // обрабатывает все кодировки
        curl_setopt($ch, CURLOPT_USERAGENT, $this->useragent);  // useragent
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); // таймаут соединения
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);        // таймаут ответа
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);       // останавливаться после 10-ого редиректа
        curl_setopt($ch, CURLOPT_COOKIEJAR, "/libs/config/coo");
        curl_setopt($ch, CURLOPT_COOKIEFILE, "/libs/config/coo");

        $content = curl_exec($ch);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        $header = curl_getinfo($ch);
        curl_close($ch);

        $header['errno'] = $err;
        $header['errmsg'] = $errmsg;
        $header['content'] = $content;
        return $header;
    }

    function post_content($url, $postdata) {
      
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_USERAGENT, $this->useragent);  // useragent
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_COOKIEJAR, "/libs/config/coo");
        curl_setopt($ch, CURLOPT_COOKIEFILE, "/libs/config/coo");

        $content = curl_exec($ch);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        $header = curl_getinfo($ch);
        curl_close($ch);

        $header['errno'] = $err;
        $header['errmsg'] = $errmsg;
        $header['content'] = $content;
        return $header;
    }

}
