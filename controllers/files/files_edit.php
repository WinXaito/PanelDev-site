<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 08.03.2017
 */

require_once __DIR__.'/../init.php';
Wx_Session::requireAuthentication();

if(isset($_GET['uniqId']) && !empty($_GET['uniqId'])){
    $file = Wx_Std_FilesManager::get($_GET['uniqId']);

    if($file == null)
        Wx_Errors::setAndShowError(404);

    $project = Wx_ProjectManager::getId($file->getProjectId());

    if($project == null)
        Wx_Errors::setAndShowError(500);

    if($project->getOwner() != Wx_Session::getUser()->getId())
        Wx_Errors::setAndShowError(403);
}else{
    Wx_Errors::setAndShowError(404);
}

if(isset($_POST['file_name']) && isset($_POST['file_description']) && isset($_POST['file_public'])){
    if(!empty($_POST['file_name']))
        $file->setName($_POST['file_name']);

    if($_POST['file_public'] == 'yes')
        $file->setPublic(true);
    else
        $file->setPublic(false);

    $file->setDescription($_POST['file_description']);

    if(isset($_POST['submit']))
        Wx_Std_FilesManager::update($file);
}


$tab['projects'] = "active";

$breadcrum = new Wx_Breadcrum(
    true,
    [
        'Accueil' => '',
        'Fichiers' => '/files/edit/'.$file->getUniqId(),
        'Edition' => 'edit'
    ]
);

echo $twig->render('templates_pages/files/files_edit.twig', [
    'tab' => $tab,
    'breadcrum' => $breadcrum->getBreadcrum(),
    'file' => $file,
    'project' => $project,
]);

Wx_Utils::showDebugInfos();