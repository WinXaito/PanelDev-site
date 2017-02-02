<?php
/**
 * Project: PanelDev
 * License: GPL3.0 ©All right reserved
 * User: WinXaito
 */

require_once __DIR__.'/../init.php';

$_add = "";
if(isset($_POST['profile_username'])){
    if(!empty($_POST['profile_password'])){
        $_User->setPassword($_POST['profile_password']);
        $_User->setPasswordConfirm($_POST['profile_passwordConfirm']);
    }else{
        $_User->setPasswordConfirm($_User->getPassword());
    }

    $_User->setEmail($_POST['profile_email']);
    $_User->setFirstName($_POST['profile_firstname']);
    $_User->setLastName($_POST['profile_lastname']);

    $_UserManager->update($_User);

    $_add = $_UserManager->getErrors();

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