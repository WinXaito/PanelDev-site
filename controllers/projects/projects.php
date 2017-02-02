<?php
/**
 * Project: PanelDev
 * License: GPL3.0 ©All right reserved
 * User: WinXaito
 */

require_once __DIR__.'/../init.php';

$tab['projects'] = "active";

$projectManager = new Wx_ProjectManager($_HistoricManager, $_User);
$projects = $projectManager->getAllProjects($_User);
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