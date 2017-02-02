<?php
/**
 * Project: paneldev
 * License: GPL3.0 ©Allright reserved
 * User: WinXaito
 */

require_once __DIR__.'/../init.php';

$tab['projects'] = "active";

$url = isset($_GET['url']) ? $_GET['url'] : "";
$projectManager = new Wx_ProjectManager($_HistoricManager, $_User);
$projectContent = $projectManager->get($_GET['url']);

if(!$projectContent)
    $_Error->setAndShowError(404);
if($projectContent->getOwner() !=$_User->getId() && !in_array($projectContent->getUsers(true), [$_User->getName()]))
    $_Error->setAndShowError(403);


$breadcrum = new Wx_Breadcrum(
    false,
    [
        'Accueil' => '',
        'Projets' => 'projects',
        $projectContent->getName() => '/project/'.$projectContent->getUrl(),
    ]
);

switch($projectContent->getType()){
    case 'general':
        $template = 'templates_apps/general/content_viewgeneral.twig';
        break;
    case 'website':
        $template = 'templates_apps/website/content_viewwebsite.twig';
        break;
    case 'print3d':
        $template = 'templates_apps/print3d/print3d_view.twig';
        break;
    default:
        $error->setAndShowError(500);
}


echo $twig->render($template, [
    'tab' => $tab,
    'breadcrum' => $breadcrum->getBreadcrum(),
    'project' => $projectContent,
]);

Wx_Utils::showDebugInfos();