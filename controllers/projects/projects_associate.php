<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 05.02.2017
 */

require_once __DIR__.'/../init.php';

Wx_Session::requireAuthentication();

$tab['projects'] = "active";

$projects = Wx_ProjectManager::getAllProjects(Wx_Session::getUser());

$breadcrum = new Wx_Breadcrum(
    false,
    [
        'Accueil' => '',
        'Projets' => 'projects'
    ]
);

echo $twig->render('templates_pages/projects/content_projects_associate.twig', [
    'tab' => $tab,
    'breadcrum' => $breadcrum->getBreadcrum(),
    'projects' => $projects,
]);

Wx_Utils::showDebugInfos();