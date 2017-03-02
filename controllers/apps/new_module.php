<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 31.01.2017
 */

require_once __DIR__ . '/../private_init.php';

$tab['projects'] = "active";

$url = isset($_GET['url']) ? $_GET['url'] : "";

$projectContent = Wx_ProjectManager::get($_GET['url']);

if(!$projectContent)
    $_Error->setAndShowError(404);
if($projectContent->getOwner() != Wx_Session::getUser()->getId())
    $_Error->setAndShowError(403);

switch($projectContent->getType()){
    case 'print3d':
        require_once __DIR__.'/print3d/print3d_new.php';
        break;
    default:
        $_Error->setAndShowError(500);
}