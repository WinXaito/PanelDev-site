<?php
/**
 * Project: PanelDev
 * License: GPL3.0 ©All right reserved
 * User: WinXaito
 */

//Load Required file
require_once __DIR__.'/../config.php';
require_once __DIR__.'/../models/Autoload.php';

//Start Session
if(session_id() == null)
    session_start();

//Active AutoClassCharger
spl_autoload_register('autoload');

//Twig
$loader = new Twig_Loader_Filesystem(__DIR__.'/../views/');
//Twig cache: __DIR__.'/../temp/twig_cache/'

if(TWIG_CACHE) {
    $twig = new Twig_Environment($loader, ['debug' => DEBUG, 'cache' => __DIR__ . '/../temp/twig_cache/']);
}else {
    $twig = new Twig_Environment($loader, ['debug' => DEBUG, 'cache' => false]);
    $twig->addExtension(new Twig_Extension_Debug());
}

$twig->addGlobal("URL", URL_PATH);
$twig->addGlobal("session", $_SESSION);

//Initialize error class
$_Error = new Wx_Errors($twig);

//Check Authentification
if(isset($_SESSION['user']['id'])){
    $_UserManager = new Wx_UserManager();
    $_User = $_UserManager->getUserById($_SESSION['user']['id']);
    $_HistoricManager = new Wx_HistoricManager($_User);
    $_UserManager->setHistoricManager($_HistoricManager);

    $twig->addGlobal("user", $_User);
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
