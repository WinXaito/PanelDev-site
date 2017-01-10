<?php
	/**
	 * Project: PanelDev
	 * License: GPL3.0 ©All right reserved
	 * User: WinXaito
	 */

	require_once __DIR__.'/../init.php';

	//Treatment
	$add_informations = "";
	if(isset($_POST['project_name'])&&isset($_POST['project_type'])&&isset($_POST['project_description'])&&isset($_POST['project_url'])){
		$value__project_name = $_POST['project_name'];
		$value__project_description = $_POST['project_description'];
		$value__project_url = $_POST['project_url'];

		if(!empty($_POST['project_name'])&&!empty($_POST['project_url'])&&!empty($_POST['project_type'])){
			$projectManager = new ProjectManager($bdd , $_HistoricManager, $_User);
            $projectContent = new Project(
                $_POST['project_name'],
                $_User->getId(),
                "",
                $_POST['project_type'],
                $_POST['project_description'],
                $projectManager->newUrl(),
                $_POST['project_url'],
                time(),
                0
            );

            $projectManager->add($projectContent);
            $add_informations = $projectManager->getErrors();

            if(empty($add_informations))
                header("Location:".URL_PATH."/project/".$projectContent->getUrl().'/view');
		}else{
			$add_informations .= '<p class="bg-primary message">Tous les champs nécéssaire n\'ont pas été rempli</p>';
		}
	}


	$breadcrum = new Breadcrum(
		true,
		[
			'Accueil' => '',
			'Projets' => '/projects',
			'Nouveau' => '/project/new',
		]
	);
	$tab['projects'] = "active";

	$complement['content'] = include PATH.'/views/templates_pages/projects/content_newproject.php';

	require_once PATH.'/views/default.php';