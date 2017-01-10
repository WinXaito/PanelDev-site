<?php
    /**
     * Project: paneldev
     * License: GPL3.0 ©Allright reserved
     * User: WinXaito
     */

    require_once __DIR__.'/../init.php';
    require_once PATH.'/models/bdd.php';

    $tab['projects'] = "active";

    if(!isset($_GET['url']))
        $_GET['url'] = "";

    $projectManager = new ProjectManager($bdd, $_HistoricManager, $_User);
    $projectContent = $projectManager->get($_GET['url']);

    $error = new Errors();
    if(!$projectContent)
        $error->setAndShowError(404);
    if($projectContent->getOwner() !=$_User->getId() && !in_array($projectContent->getUsers(true), [$_User->getName()]))
        $error->setAndShowError(403);

    $breadcrum = new Breadcrum(
        true,
        [
            'Accueil' => '',
            'Projets' => '/projects',
            $projectContent->getName() => '/project/'.$projectContent->getUrl(),
        ]
    );
    $complement['content'] = include PATH.'/views/templates_pages/projects/content_viewproject.php';

    require_once PATH.'/views/default.php';