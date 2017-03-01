<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 01.03.2017
 */

require_once __DIR__.'/../api_init.php';

Api_Authorization::requireAuthentication();

switch($_SERVER['REQUEST_METHOD']){
    case 'GET':

        break;
    default:
        Api_Render::error(405);
}