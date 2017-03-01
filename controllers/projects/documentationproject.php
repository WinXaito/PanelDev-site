<?php
/**
 * Project: paneldev
 * License: GPL3.0
 * User: WinXaito
 */

require_once __DIR__.'/../init.php';

$tab['projects'] = "active";

if(!isset($_GET['url']))
    $_GET['url'] = "";

$projectContent = Wx_ProjectManager::get($_GET['url']);

if(!$projectContent)
    $_Error->setAndShowError(404);
if($projectContent->getOwner() != $_User->getId() && !in_array($projectContent->getUsers(true), [$_User->getName()]))
    $_Error->setAndShowError(403);


$breadcrum = new Wx_Breadcrum(
    true,
    [
        'Accueil' => '',
        'Projets' => '/projects',
        $projectContent->getName() => '/project/'.$projectContent->getUrl().'/view',
        'Documentation' => '/project/'.$projectContent->getUrl().'/view/documentation',
    ]
);
$complement['content'] = include PATH.'/views/templates_pages/projects/content_documentationproject.php';

require_once PATH.'/views/default.php';