<?php
/**
 * Project: PanelDev
 * License: GPL3.0 ©All right reserved
 * User: WinXaito
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

echo $twig->render('templates_pages/projects/content_projects.twig', [
    'tab' => $tab,
    'breadcrum' => $breadcrum->getBreadcrum(),
    'projects' => $projects,
]);

Wx_Utils::showDebugInfos();