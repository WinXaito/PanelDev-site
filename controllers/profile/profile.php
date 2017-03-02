<?php
/**
 * Project: PanelDev
 * License: GPL3.0 ©All right reserved
 * User: WinXaito
 */

require_once __DIR__.'/../private_init.php';

$_add = "";
if(isset($_POST['profile_username'])){
    $user = Wx_Session::getUser();

    if(!empty($_POST['profile_password'])){
        $user->setPassword($_POST['profile_password']);
        $user->setPasswordConfirm($_POST['profile_passwordConfirm']);
    }else{
        $user->setPasswordConfirm($user->getPassword());
    }

    $user->setEmail($_POST['profile_email']);
    $user->setFirstName($_POST['profile_firstname']);
    $user->setLastName($_POST['profile_lastname']);

    Wx_UserManager::update($user);

    $_add = Wx_UserManager::getErrors();

    if(empty($_add))
        $_add = '<p class="bg-primary message">Votre profile à bien été modifié</p>';
}

$breadcrum = new Wx_Breadcrum(
    false,
    [
        'Accueil' => '',
        'Profile' => 'profile'
    ]
);

echo $twig->render('templates_pages/profile/content_profile.twig', [
    'tab' => $tab,
    'breadcrum' => $breadcrum->getBreadcrum(),
    'message' => $_add,
]);

Wx_Utils::showDebugInfos();