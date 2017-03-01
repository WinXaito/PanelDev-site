<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 26.02.2017
 */

//Ajax header for JSON
//header('Content-Type: application/json; charset=utf-8');

//Load Required file
require_once __DIR__.'/../config.php';
require_once __DIR__.'/../models/Autoload.php';

//Start Session
if(session_id() == null)
    session_start();

//Active AutoClassCharger
spl_autoload_register('autoload');

//Check Authentification
if(isset($_SESSION['user']['id'])){
    $user = Wx_UserManager::getUserById($_SESSION['user']['id']);
    Wx_Session::init($user);
}else{
    if($_SERVER['REQUEST_URI'] != URL_PATH."/login" && $_SERVER['REQUEST_URI'] != URL_PATH."/register")
        header("Location:".URL_PATH."/login");
}