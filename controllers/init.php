<?php
	/**
	 * Project: PanelDev
	 * License: GPL3.0 ©All right reserved
	 * User: WinXaito
	 */

    //Load Required file
	require_once __DIR__.'/../config.php';
    require_once PATH.'/models/bdd.php';

    //Start Session
	session_start();

    //Active AutoClassCharger
    spl_autoload_register('autoClass');

    //Check Authentification
    if(isset($_SESSION['user']['id'])){
        $_UserManager = new UserManager($bdd);
        $_User = $_UserManager->getUserById($_SESSION['user']['id']);
        $_HistoricManager = new HistoricManager($bdd, $_User);
        $_UserManager->setHistoricManager($_HistoricManager);
    }else{
        if($_SERVER['REQUEST_URI'] != URL_PATH."/login" && $_SERVER['REQUEST_URI'] != URL_PATH."/register")
            header("Location:".URL_PATH."/login");
    }


	$tab = [
		"home" => "",
		"projects" => "",
		"cloud" => "",
		"options" => "",
        "historic" => "",
		"help" => "",
	];


    /**
     * @param $class
     */
    function autoClass($class){
        require_once PATH.'/models/class/'.$class.'.class.php';
    }