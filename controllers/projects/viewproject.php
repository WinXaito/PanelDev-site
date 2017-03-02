<?php
/**
 * Project: paneldev
 * License: GPL3.0 ©Allright reserved
 * User: WinXaito
 */

require_once __DIR__.'/../private_init.php';

$tab['projects'] = "active";

$url = isset($_GET['url']) ? $_GET['url'] : "";
$projectContent = Wx_ProjectManager::get($_GET['url']);

if(!$projectContent)
    $_Error->setAndShowError(404);
if($projectContent->getOwner() != Wx_Session::getUser()->getId() && !in_array($projectContent->getUsers(true), [Wx_Session::getUser()->getName()]))
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