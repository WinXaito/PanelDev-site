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

$projectManager = new Wx_ProjectManager($bdd, $_HistoricManager, $_User);
$projectContent = $projectManager->get($_GET['url']);

$error = new Wx_Errors();
if(!$projectContent)
    $error->setAndShowError(404);
if($projectContent->getOwner() != $_SESSION['user']['id'])
    $error->setAndShowError(403);

$message = "";
if(isset($_POST['username']) && isset($_POST['access'])){
    if($_POST['access'] != 3 && $_POST['access'] != 2 && $_POST['access'] != 1)
        $_POST['access'] = 3;

    $addUser = $_UserManager->getUserByName($_POST['username']);

    if($addUser){
        $message = $projectManager->addUser($projectContent, $addUser, $_POST['access']);
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