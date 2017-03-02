<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 15.02.2017
 */

require_once __DIR__.'/../private_init.php';

if(isset($_GET['uniqId'])){
    $file = Wx_Std_FilesManager::get($_GET['uniqId']);

    if($file == null)
        $_Error->setAndShowError(404);
}else{
    $_Error->setAndShowError(404);
}

$action = isset($_GET['action']) ? $_GET['action'] : "download";
$file_path = __DIR__.'/../../media/users/'.Wx_Session::getUser()->getId().'/projects/'.$file->getProjectId().'/files/'.$file->getUniqId().'.wx';

if(!file_exists($file_path))
    $_Error->setAndShowError(500);

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
    $_Error->setAndShowError(500);
}