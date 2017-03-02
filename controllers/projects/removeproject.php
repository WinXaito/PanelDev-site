<?php
/**
 * Project: paneldev
 * License: GPL3.0 ©All right reserved
 * User: WinXaito
 */

require_once __DIR__.'/../private_init.php';

$tab['projects'] = "active";

if(!isset($_GET['url']))
    $_GET['url'] = "";

$projectContent = Wx_ProjectManager::get($_GET['url']);

if(!$projectContent)
    $_Error->setAndShowError(404);
if($projectContent->getOwner() != Wx_Session::getUser()->getId())
    $_Error->setAndShowError(403);

$removed = false;
$add_informations = "";
if(isset($_POST['remove'])&&isset($_POST['password'])){
    $usersContent = Wx_UserManager::getUserById(Wx_Session::getUser()->getId());

    if(sha1($_POST['password']) == $usersContent->getPassword()){
        Wx_ProjectManager::remove($projectContent->getUrl());
        $removed = true;
    }else{
        $add_informations = "<p class=\"alert-danger message\">Le mot de passe indiqué n'est pas correcte</p>";
    }
}


$breadcrum = new Wx_Breadcrum(
    true,
    [
        'Accueil' => '',
        'Projets' => '/projects',
        $projectContent->getName() => '/project/'.$projectContent->getUrl().'/view',
        'Suppression' => '/project/'.$projectContent->getUrl().'/remove',
    ]
);

echo $twig->render('templates_pages/projects/content_removeproject.twig', [
    'tab' => $tab,
    'breadcrum' => $breadcrum->getBreadcrum(),
    'project' => $projectContent,
    'message' => $add_informations,
    'removed' => $removed,
]);

Wx_Utils::showDebugInfos();