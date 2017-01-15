<?php
	/**
	 * Project: PanelDev
	 * License: GPL3.0 ©All right reserved
	 * User: WinXaito
	 */

	require_once __DIR__.'/../init.php';

	//Treatment
	$add_informations = "";
    $value = [];
	if(isset($_POST['project_name'])&&isset($_POST['project_type'])&&isset($_POST['project_description'])&&isset($_POST['project_url'])){
        $value['name'] = $_POST['project_name'];
        $value['description'] = $_POST['project_description'];
        $value['url'] = $_POST['project_url'];

		if(!empty($_POST['project_name'])&&!empty($_POST['project_type'])){
		    if(!filter_var($_POST['project_url'], FILTER_VALIDATE_URL))
		        $_POST['project_url'] = '';

			$projectManager = new Wx_ProjectManager($bdd , $_HistoricManager, $_User);
            $projectContent = new Wx_Project(
                $_POST['project_name'],
                $_User->getId(),
                [],
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


	$breadcrum = new Wx_Breadcrum(
		false,
		[
			'Accueil' => '',
			'Projets' => 'projects',
			'Nouveau' => '/new',
		]
	);
	$tab['projects'] = "active";

	$complement['content'] = include PATH.'/views/templates_pages/projects/content_newproject.php';

	echo $twig->render('templates_pages/projects/content_newproject.twig', [
	    'tab' => $tab,
        'breadcrum' => $breadcrum->getBreadcrum(),
        'value' => $value,
        'message' => $add_informations,
    ]);