<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 27.02.2017
 */

require_once __DIR__.'/../../init.php';

$profileUser = Wx_UserManager::getUserByName($_GET['name']);

if(!$profileUser)
    Wx_Errors::setAndShowError(404);


$projects = null;
if($profileUser->isProfilPublic())
    $projects = Wx_ProjectManager::getOwnerProjects($profileUser);


$tab['users'] = 'active';

$breadcrum = new Wx_Breadcrum(
    false,
    [
        'Accueil' => '',
        'Utilisateur' => 'users',
        $profileUser->getName() => '',
    ]
);

echo $twig->render('templates_pages/public/users/public_profile.twig', [
    'tab' => $tab,
    'breadcrum' => $breadcrum->getBreadcrum(),
    'profileUser' => $profileUser,
    'projects' => $projects,
]);

Wx_Utils::showDebugInfos();