<?php
	/**
	 * Project: PanelDev
	 * License: GPL3.0 ©All right reserved
	 * User: WinXaito
	 */

	require_once __DIR__.'/../../../config.php';

    if(!$projectManager->hasProjects($_User))
        $projects = "Vous ne possédez aucun projet";
    else
        $projects = $projectManager->showAllProjectsTable($_User);

	return '
		<div>
			<div>
				<a href="'.URL_PATH.'/project/new" class="">Créer un nouveau projet</a>
			</div>
			<div>
				<h3>Liste de vos projets</h3>

			    '.$projects.'
			</div>
		</div>
	';