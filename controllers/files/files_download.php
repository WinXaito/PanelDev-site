<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 15.02.2017
 */

require_once __DIR__.'/../init.php';

if(isset($_GET['uniqId'])){
    $file = Wx_Std_FilesManager::get($_GET['uniqId']);

    if($file == null)
        Wx_Errors::setAndShowError(404);
}else{
    Wx_Errors::setAndShowError(404);
}

if(!$file->isPublic()){
    $project = Wx_ProjectManager::getId($file->getParent()->getProjectId());

    if(!Wx_Session::isAuthenticated() || $project->getOwner() != Wx_Session::getUser()->getId())
        Wx_Errors::setAndShowError(403);
}

$action = isset($_GET['action']) ? $_GET['action'] : "download";
$file_path = __DIR__.'/../../media/users/'.Wx_Session::getUser()->getId().'/projects/'.$file->getProjectId().'/files/'.$file->getUniqId().'.wx';

if(!file_exists($file_path))
    Wx_Errors::setAndShowError(500);

if($action == 'download'){
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.$file->getName().'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_path));
    readfile($file_path);
    exit;
}else if($action == 'display'){
    header('Content-Type: image/*');
    readfile($file_path);
    exit;
}else{
    Wx_Errors::setAndShowError(500);
}