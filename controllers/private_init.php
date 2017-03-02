<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 02.03.2017
 */

require_once __DIR__.'/init.php';

if($_SERVER['REQUEST_URI'] != URL_PATH."/login" && $_SERVER['REQUEST_URI'] != URL_PATH."/register")
    header("Location:".URL_PATH."/login");