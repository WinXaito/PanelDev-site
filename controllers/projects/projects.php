<?php
/**
 * Project: PanelDev
 * License: GPL3.0 ©All right reserved
 * User: WinXaito
 */

require_once __DIR__.'/../init.php';

Wx_Session::requireAuthentication();

$tab['projects'] = "active";

$TYPE = ['website' => 'Site web', 'general' => 'Général', 'print3d' => 'Impression 3D'];
$projects = Wx_ProjectManager::getAllUserProjects(Wx_Session::getUser());
$type = isset($_GET['type']) && !empty($_GET['type']) && array_key_exists($_GET['type'], $TYPE) ? $_GET['type'] : 'all';

if($type == 'all') {
    $breadcrum = new Wx_Breadcrum(
        false,
        [
            'Accueil' => '',
            'Projets' => 'projects',
        ]
    );
}else{
    $breadcrum = new Wx_Breadcrum(
        false,
        [
            'Accueil' => '',
            'Projets' => 'projects',
            $TYPE[$type] => $type,
        ]
    );
}

echo $twig->render('templates_pages/projects/content_projects.twig', [
    'tab' => $tab,
    'breadcrum' => $breadcrum->getBreadcrum(),
    'projects' => $projects,
    'type' => $type,
]);

Wx_Utils::showDebugInfos();