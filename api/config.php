<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 28.02.2017
 */

//Generale
define('API_PATH', __DIR__);
define('API_DEBUG', false);
define('API_DEBUG_AUTOLOAD', false);
define('API_TWIG_CACHE', false);

//Url
switch($_SERVER['HTTP_HOST']){
    case 'localhost':
        define('API_URL_PATH', "/winxaito/paneldev/api");
        define('API_URL_PATH_HOME', "/winxaito/paneldev/api/");
        break;
    case 'projectsmanager.dev':
        define('API_URL_PATH', "/api/");
        define('API_URL_PATH_HOME', "/api");
        break;
    default:
        define('API_URL_PATH', "/api/");
        define('API_URL_PATH_HOME', "/api");
}

//BDD
define('DB_HOST', 'localhost');
define('DB_NAME', 'paneldev');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

//Data displaying (Number)
define('API_PAGINATION_NUMBER', 20);