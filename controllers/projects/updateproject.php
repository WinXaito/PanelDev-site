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
    if(isset($_POST['project_name'])&&isset($_POST['project_description'])&&isset($_POST['project_url'])){
        if(!empty($_POST['project_name'])&&!empty($_POST['project_description'])&&!empty($_POST['project_url'])){
            $projectContent->setName($_POST['project_name']);
            $projectContent->setDescription($_POST['project_description']);
            $projectContent->setUrlProject($_POST['project_url']);
            $projectContent->setDateModification(time());
            $projectManager->update($projectContent, $projectContent->getUrl());

            $add_informations .= "<p class=\"bg-primary message\">Le projet à été correctement modifié</p>";
        }else{
            $add_informations .= "<p class=\"bg-primary message\">Tous les champs n'ont pas été remplis</p>";
        }
    }


    $breadcrum = new Breadcrum(
        true,
        [
            'Accueil' => '',
            'Projets' => '/projects',
            $projectContent->getName() => '/project/'.$projectContent->getUrl().'/view',
            'Modification' => '/project/'.$projectContent->getUrl().'/update',
        ]
    );
    $complement['content'] = include PATH.'/views/templates_pages/projects/content_updateproject.php';
    require_once PATH.'/views/default.php';