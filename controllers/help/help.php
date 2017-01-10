<?php
	/**
	 * Project: PanelDev
	 * License: GPL3.0 ©All right reserved
	 * User: WinXaito
	 */

	require_once __DIR__.'/../init.php';

	$tab['help'] = "active";
	$breadcrum = new Breadcrum(
        false,
		[
            'Accueil' => '',
            'Aide' => 'help'
        ]
    );
	$complement['content'] = include PATH.'/views/templates_pages/help/content_help.php';

	require_once PATH.'/views/default.php';