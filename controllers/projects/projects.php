<?php
	/**
	 * Project: PanelDev
	 * License: GPL3.0 ©All right reserved
	 * User: WinXaito
	 */

	require_once __DIR__.'/../init.php';

	$tab['projects'] = "active";

    $projectManager = new Wx_ProjectManager($bdd , $_HistoricManager, $_User);

	$breadcrum = new Wx_Breadcrum(
        false,
        [
            'Accueil' => '',
            'Projets' => 'projects'
        ]
    );
	$complement['content'] = include PATH.'/views/templates_pages/projects/content_projects.php';

	require_once PATH.'/views/default.php';