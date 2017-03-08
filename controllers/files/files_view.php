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

$tab['projects'] = "active";

$breadcrum = new Wx_Breadcrum(
    true,
    [
        'Accueil' => '',
        'Fichiers' => '/files/view/'.$file->getUniqId(),
        'Edition' => 'edit'
    ]
);

echo $twig->render('templates_pages/files/files_view.twig', [
    'tab' => $tab,
    'breadcrum' => $breadcrum->getBreadcrum(),
    'file' => $file,
    'project' => $project,
]);

Wx_Utils::showDebugInfos();