<?php
/**
 * Project: PanelDev
 * License: GPL3.0 ©All right reserved
 * User: WinXaito
 */

require_once __DIR__.'/../init.php';

if(isset($_User)){
    header("Location:".URL_PATH."/");
}

$_add = '';
if(isset($_POST['username'])&&isset($_POST['password'])){
    if(empty($_POST['username']))
        $_add .= '<p class="bg-primary message"">Nom d\'utilisateur non renseigné</p>';
    if(empty($_POST['password']))
        $_add .= '<p class="bg-primary message">Mot de passe non renseigné</p>';

    if(empty($_add)){
        $_UserManager = new Wx_UserManager();
        $_User = $_UserManager->getUserByName($_POST['username']);

        if($_User){
            $_HistoricManager = new Wx_HistoricManager($_User);

            if($_User->getPassword() == sha1($_POST['password'])){
                $_SESSION['user']['id'] = $_User->getId();
                $_Historic = new Wx_Historic($_User, 1, "Connexion", "Connexion réussi", time(), $_SERVER['REMOTE_ADDR']);
                $_HistoricManager->add($_Historic);
                header("Location:".URL_PATH_HOME);
            }else{
                $_Historic = new Wx_Historic($_User, 1, "Connexion", "Echec de la connexion", time(), $_SERVER['REMOTE_ADDR']);
                $_HistoricManager->add($_Historic);

                $_add .= '<p class="bg-primary message">Le mot de passe indiqué n\'est pas correcte</p>';
            }
        }else{
            $_add .= '<p class="bg-primary message">Le nom d\'utilisateur spécifié est inexistant</p>';
        }
    }
}

echo $twig->render('templates_pages/authenticate/login.twig', [
    'message' => $_add,
]);

Wx_Utils::showDebugInfos();