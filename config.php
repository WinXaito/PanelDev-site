<?php
/**
 * Project: PanelDev
 * License: GPL3.0 ©All right reserved
 * User: WinXaito
 */

//Generale
    define('PATH', __DIR__);
    define('DEBUG', true);
    define('DEBUG_AUTOLOAD', false);
    define('TWIG_CACHE', false);

//Url
    switch($_SERVER['HTTP_HOST']){
        case 'localhost':
            define('URL_PATH', "/winxaito/paneldev");
            define('URL_PATH_HOME', "/winxaito/paneldev/");
            break;
        case 'projectsmanager.dev':
            define('URL_PATH', "");
            define('URL_PATH_HOME', "/");
            break;
        default:
            define('URL_PATH', "");
            define('URL_PATH_HOME', "/");
    }
    define('URL_PROJECTS_LENGTH', 6);

//BDD
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'paneldev');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');

//FILES
    //Stl file (3d print) maxsize (512Mo -> 536870912o)
    define('FILES_APPS_PRINT3D_STL_MAXSIZE', 536870912);
    define('FILES_APPS_PRINT3D_GCODE_MAXSIZE', 536870912);
    define('FILES_APPS_PRINT3D_OTHER_MAXSIZE', 536870912);
    define('FILES_APPS_PRINT3D_IMAGE_MAXSIZE', 536870912);