<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 28.02.2017
 */

require_once __DIR__.'/../config.php';
require_once __DIR__.'/../models/Autoload.php';

//Set output JSON content-type
//header('Content-Type: application/json; charset=utf-8');

//Active AutoClassCharger
spl_autoload_register('autoload');