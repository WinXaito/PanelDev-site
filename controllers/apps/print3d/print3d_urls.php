<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 29.01.2017
 */

/**
 * @var error Wx_Error
 */

switch($_GET['type']){
    case 'files':
        $template = 'templates_apps/print3d/print3d_files.twig';
        $breadcrum_type = 'Fichiers';
        break;
    case 'gcode':
        $template = 'templates_apps/print3d/print3d_gcode.twig';
        $breadcrum_type = 'GCode';
        break;
    case 'result':
        $template = 'templates_apps/print3d/print3d_result.twig';
        $breadcrum_type = 'Résultat';
        break;
    case 'infos':
        $template = 'templates_apps/print3d/print3d_infos.twig';
        $breadcrum_type = 'Informations';
        break;
    default:
        $error->setAndShowError(404);
}

$breadcrum = new Wx_Breadcrum(
    true,
    [
        'Accueil' => '',
        'Projets' => 'projects',
        $projectContent->getName() => '/project/'.$projectContent->getUrl().'/view',
        $breadcrum_type => '',
    ]
);

echo $twig->render($template, [
    'tab' => $tab,
    'breadcrum' => $breadcrum->getBreadcrum(),
    'project' => $projectContent,
]);