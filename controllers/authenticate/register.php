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
        $user = new Wx_User($_POST['username'], $_POST['password'], $_POST['email'], "", "", Wx_User::GRADE_INITIAL, false);
        $user->setPasswordConfirm($_POST['confirmPassword']);
        Wx_UserManager::add($user);

        $_add .= Wx_UserManager::getErrors();

        if(empty($_add)){
            $user = Wx_UserManager::getUserByName($user->getName());
            $_SESSION['user']['id'] = $user->getId();
            Wx_Session::init($user);
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

$tab['register'] = 'active';

echo $twig->render('templates_pages/authenticate/register.twig', [
    'message' => $_add,
    'preset' => $preset,
    'tab' => $tab,
]);

Wx_Utils::showDebugInfos();