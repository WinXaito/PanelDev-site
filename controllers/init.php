<?php
	/**
	 * Project: PanelDev
	 * License: GPL3.0 ©All right reserved
	 * User: WinXaito
	 */

    //Load Required file
	require_once __DIR__.'/../config.php';
    require_once __DIR__.'/../models/bdd.php';
    require_once __DIR__.'/../models/Autoload.php';

    //Start Session
    if(session_id() == null)
	    session_start();

    //Active AutoClassCharger
    spl_autoload_register('autoload');


    //Check Authentification
    if(isset($_SESSION['user']['id'])){
        $_UserManager = new Wx_UserManager($bdd);
        $_User = $_UserManager->getUserById($_SESSION['user']['id']);
        $_HistoricManager = new Wx_HistoricManager($bdd, $_User);
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
    function personnalClass($class){
        require_once __DIR__ . '/../models/class/' . $class . '.class.php';
    }
