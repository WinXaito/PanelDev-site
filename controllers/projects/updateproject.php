<?php
/**
 * Project: paneldev
 * License: GPL3.0 ©All right reserved
 * User: WinXaito
 */

require_once __DIR__.'/../init.php';

$tab['projects'] = "active";

if(!isset($_GET['url']))
    $_GET['url'] = "";

$projectContent = Wx_ProjectManager::get($_GET['url']);

if(!$projectContent)
    $_Error->setAndShowError(404);
if($projectContent->getOwner() != Wx_Session::getUser()->getId())
    $_Error->setAndShowError(403);

$add_informations = "";
if(isset($_POST['project_name'])&&isset($_POST['project_description'])&&isset($_POST['project_url'])){
    if(!empty($_POST['project_name'])&&!empty($_POST['project_description'])){
        if(!filter_var($_POST['project_url'], FILTER_VALIDATE_URL))
            $_POST['project_url'] = '';

        $projectContent->setName($_POST['project_name']);
        $projectContent->setDescription($_POST['project_description']);
        $projectContent->setUrlProject($_POST['project_url']);
        $projectContent->setDateModification(time());
        Wx_ProjectManager::update($projectContent, $projectContent->getUrl());

        $add_informations .= "<p class=\"bg-primary message\">Le projet à été correctement modifié</p>";
    }else{
        $add_informations .= "<p class=\"bg-primary message\">Tous les champs n'ont pas été remplis</p>";
    }
}


$breadcrum = new Wx_Breadcrum(
    true,
    [
        'Accueil' => '',
        'Projets' => '/projects',
        $projectContent->getName() => '/project/'.$projectContent->getUrl().'/view',
        'Modification' => '/project/'.$projectContent->getUrl().'/update',
    ]
);

echo $twig->render('templates_pages/projects/content_updateproject.twig', [
    'tab' => $tab,
    'breadcrum' => $breadcrum->getBreadcrum(),
    'project' => $projectContent,
    'message' => $add_informations,
]);

Wx_Utils::showDebugInfos();