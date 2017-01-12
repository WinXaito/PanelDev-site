<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 12.01.2017
 */
die;
require_once __DIR__.'/../init.php';
require_once __DIR__.'/errorsHeader.php';

if(isset($_GET['error'])){
    switch($_GET['error']){
        case 400:
            $error_title = E400_title;
            $error_content = E400_content;
            header($_SERVER['SERVER_PROTOCOL']." ".E400_header);
            break;
        case 401:
            $error_title = E401_title;
            $error_content = E401_content;
            header($_SERVER['SERVER_PROTOCOL']." ".E401_header);
            break;
        case 402:
            $error_title = E402_title;
            $error_content = E402_content;
            header($_SERVER['SERVER_PROTOCOL']." ".E402_header);
            break;
        case 403:
            $error_title = E403_title;
            $error_content = E403_content;
            header($_SERVER['SERVER_PROTOCOL']." ".E403_header);
            break;
        case 404:
            $error_title = E404_title;
            $error_content = E404_content;
            header($_SERVER['SERVER_PROTOCOL']." ".E404_header);
            break;
        case 500:
            $error_title = E500_title;
            $error_content = E500_content;
            header($_SERVER['SERVER_PROTOCOL']." ".E500_header);
            break;
        default:
            $error_title = "Erreur inconnu";
            $error_content = "Une erreur inconnu est survenu";
    }
}else{
    $error_title = "Erreur inconnu";
    $error_content = "Une erreur inconnu est survenu";
}

$complement['content'] = '
    <h3>'.$error_title.'</h3>
    <p><'.$error_content.'</p>
';


$breadcrum = new Breadcrum(
    false,
    [
        'Accueil' => '',
        'Erreur' => ''
    ]
);
//$complement['content'] = include PATH.'/views/templates_pages/help/content_help.php';

ob_end_clean();
require_once PATH.'/views/default.php';