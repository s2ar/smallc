<?php

class Butsa extends Controller{

    function __construct() {
        parent::__construct(); 
        Session::init();
        $logged = Session::get('loggedIn');        
        if ($logged == false){
            Session::destroy();
            header('location: login');
            exit;
        }
    }
    
    function index(){        
        $this->view->msg = 'Index';        
        ob_start();
        $this->view->team = $this->model->getTeam(1,true);
        $this->view->render('butsa/team',true);
        $html = ob_get_contents();
        ob_end_clean();
        $this->view->html = $html;       
        $this->view->render('butsa/index');
        
    }
    
    function training() {       
        $this->view->msg = 'Тренировка';
        ob_start();
        $this->view->team = $this->model->getTeam(1,true);
        $this->view->render('butsa/train',true);
        $html = ob_get_contents();
        ob_end_clean();
        $this->view->html = $html;        
        $this->view->render('butsa/training');
    }
    
    function model($param) {
        $this->view->team = $this->model->getTeam(1,true);
        $this->view->render('butsa/model');
    }
 
    
    /*---Метод получает обновленые данные игрока---*/
    function upl($player_id){         
        $this->view->player_info = $this->model->updatePlayer($player_id);  
        $this->view->render('butsa/upl');
    }
    
    /*---Метод обновляет команду по $type---*/
    function update(){         
        $this->view->team = $this->model->updateTeam();  
        $this->view->render('butsa/team');
    }
    
    /*---Метод расчитывает скил---*/
    function calcSkill(){ 
        $arP = $this->model->getPlayer(480368);
//        var_dump($arP);
//        die();
        for ($index = 0; $index < 10; $index++) {
            $newSkill = $this->model->calcSkill($arP, round($arP['mas']/7.7, 3));
            var_dump($newSkill);
            $arP['mas'] = $arP['mas'] +$newSkill;
        }
        var_dump($arP['mas']);
//        $this->view->skill = $this->model->calcSkill();  
        $this->view->render('butsa/skill');
    }
    
    /*---Метод расчитывает массу---*/
    function calcMas($player_id){ 
        $arP = $this->model->getPlayer($player_id);
        if(empty($arP)) { echo 'Игрок не найден!'; return;}
        // TODO подготовить массив игрока
//        $arPNEW = $this->model->pumpingPlayer($skills,$pos, $_POST['tren']);
        $this->view->mass = $this->model->pumpingPlayer($arP, $_POST["start_tren"], $_POST["num_tren"]);
        $this->view->render('butsa/mass');
        
    }
    /*---Метод моделирует команду---*/
    function calcTeam(){ ;
        if(!is_numeric($_POST["start_tren"]) || !is_numeric($_POST["num_tren"])) return false;
        $this->view->team = $this->model->pumpingTeam(1, $_POST["start_tren"], $_POST["num_tren"]);  
        $this->view->render('butsa/team');
        
    }
    
    function cronTrain() {
        $this->view->team = $this->model->cronTrain();
        $this->view->render('butsa/cronTrain',true);        
    }
    
    function test(){
        echo 'rrrrr';
        die();
//        var_dump($_POST);
    }
    

}