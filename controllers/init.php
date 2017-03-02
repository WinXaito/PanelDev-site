<?php
/**
 * Project: PanelDev
 * License: GPL3.0 ©All right reserved
 * User: WinXaito
 */

//Load Required file
require_once __DIR__.'/../config.php';
require_once __DIR__.'/../models/Autoload.php';

//Show error if is in debug mode
if(DEBUG){
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

//Start Session
if(session_id() == null)
    session_start();

//Active AutoClassCharger
spl_autoload_register('autoload');

//Twig
$loader = new Twig_Loader_Filesystem(__DIR__.'/../views/');

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
    $User = Wx_UserManager::getUserById($_SESSION['user']['id']);
    Wx_Session::init($User);

    $twig->addGlobal("user", Wx_Session::getUser());
}


$tab = [
    "home" => "",
    "projects" => "",
    "cloud" => "",
    "options" => "",
    "historic" => "",
    "help" => "",
];