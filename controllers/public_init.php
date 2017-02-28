<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 27.02.2017
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
