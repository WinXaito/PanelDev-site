<?php
/**
 * Project: PanelDev
 * License: GPL3.0 ©All right reserved
 * User: WinXaito
 */

require_once __DIR__.'/../init.php';

//Treatment
$_add = $preset = "";
if(isset($_POST['username'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['confirmPassword'])){
    if(!empty($_POST['username'])&&!empty($_POST['email'])&&!empty($_POST['password'])&&!empty($_POST['confirmPassword'])){
        $_UserManager = new Wx_UserManager();
        $_User = new Wx_User($_POST['username'], $_POST['password'], $_POST['email'], "", "", Wx_User::GRADE_INITIAL);
        $_User->setPasswordConfirm($_POST['confirmPassword']);
        var_dump($_User);
        $_UserManager->add($_User);

        $_add .= $_UserManager->getErrors();

        if(empty($_add)){
            $_User = $_UserManager->getUserByName($_User->getName());
            $_SESSION['user']['id'] = $_User->getId();
            header("Location:".URL_PATH_HOME);
        }
    }else{
        $_add .= "<p class=\"bg-primary message\">Tous les champs nécéssaires n'ont pas été remplis</p>";
    }

    if(!empty($_add)){
        $preset = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
        ];
    }
}

echo $twig->render('templates_pages/authenticate/register.twig', [
    'message' => $_add,
    'preset' => $preset
]);

Wx_Utils::showDebugInfos();