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

$projectContent = Wx_ProjectManager::get($_GET['url']);

if(!$projectContent)
    $_Error->setAndShowError(404);
if($projectContent->getOwner() != Wx_Session::getUser()->getId() && !in_array($projectContent->getUsers(true), [Wx_Session::getUser()->getName()]))
    $_Error->setAndShowError(403);

switch($projectContent->getType()){
    case 'print3d':
        require_once __DIR__.'/print3d/print3d_urls.php';
        break;
    default:
        $_Error->setAndShowError(500);
}