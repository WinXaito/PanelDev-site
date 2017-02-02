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

$projectManager = new Wx_ProjectManager($bdd, $_HistoricManager, $_User);
$projectContent = $projectManager->get($_GET['url']);

if(!$projectContent)
    $_Error->setAndShowError(404);
if($projectContent->getOwner() != $_User->getId())
    $_Error->setAndShowError(403);

$removed = false;
$add_informations = "";
if(isset($_POST['remove'])&&isset($_POST['password'])){
    $usersManager = new Wx_UserManager($bdd);
    $usersContent = $usersManager->getUserById($_User->getId());

    if(sha1($_POST['password']) == $usersContent->getPassword()){
        $projectManager->remove($projectContent->getUrl());
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
$complement['content'] = include PATH.'/views/templates_pages/projects/content_removeproject.php';

echo $twig->render('templates_pages/projects/content_removeproject.twig', [
    'tab' => $tab,
    'breadcrum' => $breadcrum->getBreadcrum(),
    'project' => $projectContent,
    'message' => $add_informations,
    'removed' => $removed,
]);

Wx_Utils::showDebugInfos();