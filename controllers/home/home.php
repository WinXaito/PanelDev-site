<?php
	/**
	 * Project: PanelDev
	 * License: GPL3.0 ©All right reserved
	 * User: WinXaito
	 */

	require_once __DIR__.'/../init.php';

    $projectManager = new Wx_ProjectManager($bdd, $_HistoricManager, $_User);

	$tab['home'] = "active";
	$breadcrum = new Wx_Breadcrum(false, ['Accueil' => '', 'Projet' => '/projects']);

	$complement['content'] = include PATH.'/views/templates_pages/home/content_home.php';
	$complement['js'] = include PATH.'/views/templates_pages/home/js_home.php';

	//require_once PATH.'/views/default.php';

    echo $twig->render('templates_pages/home/content_home.twig', [
        'breadcrum' => $breadcrum->getBreadcrum(),
        'tab' => $tab,
    ]);