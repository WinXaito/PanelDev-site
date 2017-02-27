<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 29.01.2017
 */

/**
 * @var error Wx_Error
 */

$render = true;

$message = [];
$TYPES = ['view' => 'Afficher', 'files' => 'Fichiers', 'gcode' => 'GCode', 'result' => 'Résultat', 'infos' => 'Informations'];
$ACTIONS = ['new' => 'Nouveau', 'update' => 'Modifier', 'remove' => 'Supprimer'];
$_GET['action'] = isset($_GET['action']) ? $_GET['action'] : "";


$print3dContent = Wx_Apps_Print3dManager::get($projectContent);

if(!empty($_GET['action'])){
    $breadcrum = new Wx_Breadcrum(
        true,
        [
            'Accueil' => '',
            'Projets' => '/projects',
            $projectContent->getName() => '/project/' . $projectContent->getUrl() . '/view',
            $TYPES[$_GET['type']] => '/project/'.$projectContent->getUrl().'/view/'.$_GET['type'],
            $ACTIONS[$_GET['action']] => '',
        ]
    );
}else {
    $breadcrum = new Wx_Breadcrum(
        true,
        [
            'Accueil' => '',
            'Projets' => '/projects',
            $projectContent->getName() => '/project/' . $projectContent->getUrl() . '/view',
            $TYPES[$_GET['type']] => '',
        ]
    );
}

switch($_GET['type']){
    case 'view':
        $template = 'templates_apps/print3d/print3d_view.twig';
        break;
    case 'files':
        $render = false;
        $template = 'templates_apps/print3d/print3d_files.twig';
        require_once __DIR__.'/print3d_files_upload.php';
        require_once __DIR__.'/print3d_files.php';
        break;
    case 'gcode':
        $template = 'templates_apps/print3d/print3d_gcode.twig';
        break;
    case 'result':
        $render = false;
        $template = 'templates_apps/print3d/print3d_result.twig';
        require_once __DIR__.'/print3d_result_upload.php';
        require_once __DIR__.'/print3d_files.php';
        break;
    case 'infos':
        switch($_GET['action']){
            case 'update':
                require_once __DIR__.'/print3d_infos_update.php';
                $template = 'templates_apps/print3d/print3d_infos_update.twig';
                break;
            default:
                $template = 'templates_apps/print3d/print3d_infos.twig';
        }
        break;
    default:
        $error->setAndShowError(404);
}

if($render) {
    echo $twig->render($template, [
        'tab' => $tab,
        'breadcrum' => $breadcrum->getBreadcrum(),
        'project' => $projectContent,
        'print3d' => $print3dContent,
        'message' => $message,
    ]);
}

Wx_Utils::showDebugInfos();