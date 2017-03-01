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
if($projectContent->getOwner() != $_SESSION['user']['id'])
    $_Error->setAndShowError(403);

$message = "";
if(isset($_POST['username']) && isset($_POST['access'])){
    if($_POST['access'] != 3 && $_POST['access'] != 2 && $_POST['access'] != 1)
        $_POST['access'] = 3;

    $addUser = Wx_UserManager::getUserByName($_POST['username']);

    if($addUser){
        $message = Wx_ProjectManager::addUser($projectContent, $addUser, $_POST['access']);
    }else{
        $message = 'L\'utilisateur spécifié n\'existe pas';
    }
}

$breadcrum = new Wx_Breadcrum(
    true,
    [
        'Accueil' => '',
        'Projets' => '/projects',
        $projectContent->getName() => '/project/'.$projectContent->getUrl().'/view',
        'Utilisateurs' => '/project/'.$projectContent->getUrl().'/users',
    ]
);

echo $twig->render('templates_pages/projects/content_usersproject.twig', [
    'tab' => $tab,
    'breadcrum' => $breadcrum->getBreadcrum(),
    'project' => $projectContent,
    'message' => $message,
    'users' => $projectContent->getUsers()->getUsers(),
]);

Wx_Utils::showDebugInfos();