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

    $add_informations_useradd = "";
    if(isset($_POST['username'])){
        $addUser = $_UserManager->getUserByName($_POST['username']);
        if($addUser){
            if($addUser->getId() == $_User->getId()){
                $add_informations_useradd .= '<p class="bg-primary message">Vous ne pouvez pas ajouter l\'administrateur du projet à la liste des utilisateurs</p>';
            }else{
                $projectManager->addUser($projectContent, $addUser->getId(), $addUser->getName());

                $add_informations_useradd .= $projectManager->getErrors();
            }
        }else{
            $add_informations_useradd .= '<p class="bg-primary message">L\'utilisateur spécifié n\'existe pas</p>';
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
    $complement['content'] = include PATH.'/views/templates_pages/projects/content_usersproject.php';

    require_once PATH.'/views/default.php';