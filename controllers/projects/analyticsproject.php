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
    $project = $projectManager->get($_GET['url']);

    $error = new Wx_Errors();
    if(!$project)
        $error->setAndShowError(404);
    if($project->getOwner() != $_User->getId())
        $error->setAndShowError(403);

    $breadcrum = new Wx_Breadcrum(
        true,
        [
            'Accueil' => "",
            'Projets' => '/projects',
            $project->getName() => '/project/'.$project->getUrl().'/view',
            'Analyse' => '/project/'.$project->getUrl().'/view/analytics',
        ]
    );
    $complement['content'] = require_once PATH.'/views/templates_pages/projects/content_analyticsproject.php';
    require_once PATH.'/views/default.php';