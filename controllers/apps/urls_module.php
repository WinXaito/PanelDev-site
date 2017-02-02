<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 29.01.2017
 */

require_once __DIR__ . '/../init.php';

$tab['projects'] = "active";

$url = isset($_GET['url']) ? $_GET['url'] : "";
$type = isset($_GET['type']) ? $_GET['type'] : "";

$projectManager = new Wx_ProjectManager($bdd, $_HistoricManager, $_User);
$projectContent = $projectManager->get($_GET['url']);

if(!$projectContent)
    $_Error->setAndShowError(404);
if($projectContent->getOwner() !=$_User->getId() && !in_array($projectContent->getUsers(true), [$_User->getName()]))
    $_Error->setAndShowError(403);

switch($projectContent->getType()){
    case 'print3d':
        require_once __DIR__.'/print3d/print3d_urls.php';
        break;
    default:
        $_Error->setAndShowError(500);
}