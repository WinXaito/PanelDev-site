<?php
/**
 * Project: PanelDev
 * License: GPL3.0 ©All right reserved
 * User: WinXaito
 */

require_once __DIR__.'/../init.php';

$tab['home'] = "active";
$breadcrum = new Wx_Breadcrum(false, ['Accueil' => '']);

if(Wx_Session::isAuthenticated()) {
    //Private Homepage (user authenticated)
    $projects = Wx_ProjectManager::getOwnerProjects(Wx_Session::getUser());

    echo $twig->render('templates_pages/home/content_home.twig', [
        'breadcrum' => $breadcrum->getBreadcrum(),
        'tab' => $tab,
        'projects' => $projects,
    ]);
}else{
    //Public Homepage
    echo $twig->render('templates_pages/home/home_public.twig', [
        'breadcrum' => $breadcrum->getBreadcrum(),
        'tab' => $tab,
    ]);
}

Wx_Utils::showDebugInfos();