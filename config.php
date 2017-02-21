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
    define('URL_PATH', "/winxaito/paneldev");
    define('URL_PATH_HOME', "/winxaito/paneldev/");
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