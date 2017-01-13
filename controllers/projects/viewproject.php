<?php
/**
 * Project: paneldev
 * License: GPL3.0 ©Allright reserved
 * User: WinXaito
 */

require_once __DIR__.'/../init.php';

$tab['projects'] = "active";

$url = isset($_GET['url']) ? $_GET['url'] : "";
$projectManager = new Wx_ProjectManager($bdd, $_HistoricManager, $_User);
$projectContent = $projectManager->get($_GET['url']);
$error = new Wx_Errors();

if(!$projectContent)
    $error->setAndShowError(404);
if($projectContent->getOwner() !=$_User->getId() && !in_array($projectContent->getUsers(true), [$_User->getName()]))
    $error->setAndShowError(403);


$breadcrum = new Wx_Breadcrum(
    true,
    [
        'Accueil' => '',
        'Projets' => '/projects',
        $projectContent->getName() => '/project/'.$projectContent->getUrl(),
    ]
);

switch($projectContent->getType()){
    case 'general':
        require_once __DIR__.'/../apps/general/general_view.php';
        break;
    case 'website':
        require_once __DIR__.'/../apps/website/website_view.php';
        break;
    default:
        $error->setAndShowError(500);
}

require_once PATH.'/views/default.php';