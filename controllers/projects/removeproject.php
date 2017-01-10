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

    $projectManager = new ProjectManager($bdd, $_HistoricManager, $_User);
    $projectContent = $projectManager->get($_GET['url']);

    $error = new Errors();
    if(!$projectContent)
        $error->setAndShowError(404);
    if($projectContent->getOwner() != $_User->getId())
        $error->setAndShowError(403);

    $add_informations = "";
    if(isset($_POST['remove'])&&isset($_POST['password'])){
        $usersManager = new UserManager($bdd);
        $usersContent = $usersManager->getUserById($_User->getId());

        if(sha1($_POST['password']) == $usersContent->getPassword()){
            $projectManager->remove($projectContent->getUrl());
            $removing = "removed";
        }else{
            $add_informations = "<p class=\"alert-danger message\">Le mot de passe indiqué n'est pas correcte</p>";
        }
    }


    $breadcrum = new Breadcrum(
        true,
        [
            'Accueil' => '',
            'Projets' => '/projects',
            $projectContent->getName() => '/project/'.$projectContent->getUrl().'/view',
            'Suppression' => '/project/'.$projectContent->getUrl().'/remove',
        ]
    );
    $complement['content'] = include PATH.'/views/templates_pages/projects/content_removeproject.php';

    require_once PATH.'/views/default.php';