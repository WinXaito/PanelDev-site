<?php
/**
 * Project: PanelDev
 * License: GPL3.0 ©All right reserved
 * User: WinXaito
 */

require_once __DIR__.'/../init.php';

$projects = Wx_ProjectManager::getOwnerProjects($_User);

$tab['home'] = "active";
$breadcrum = new Wx_Breadcrum(false, ['Accueil' => '']);

echo $twig->render('templates_pages/home/content_home.twig', [
    'breadcrum' => $breadcrum->getBreadcrum(),
    'tab' => $tab,
    'projects' => $projects,
]);

Wx_Utils::showDebugInfos();