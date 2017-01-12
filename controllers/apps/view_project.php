<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 11.01.2017
 */

//REMOVE
die;


require_once __DIR__.'/../init.php';
require_once __DIR__.'/../../models/bdd.php';

$tab['projects'] = "active";

$url = isset($_GET['url']) ? $_GET['url'] : "";
$projectManager = new ProjectManager($bdd, $_HistoricManager, $_User);
$projectContent = $projectManager->get($url);

$error = new Errors();
if(!$projectContent)
    $error->setAndShowError(404);
if($projectContent->getOwner() !=$_User->getId() && !in_array($projectContent->getUsers(true), [$_User->getId()]))
    $error->setAndShowError(403);

$breadcrum = new Breadcrum(
    true,
    [
        'Accueil' => '',
        'Projets' => '/projects',
        $projectContent->getName() => '/project/'.$projectContent->getUrl(),
    ]
);