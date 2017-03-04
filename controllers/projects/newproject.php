<?php
/**
 * Project: PanelDev
 * License: GPL3.0 ©All right reserved
 * User: WinXaito
 */

require_once __DIR__.'/../init.php';

Wx_Session::requireAuthentication();

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

        $projectContent = new Wx_Project(
            0,
            $_POST['project_name'],
            Wx_Session::getUser()->getId(),
            $_POST['project_type'],
            $_POST['project_description'],
            $projectManager->newUrl(),
            time(),
            0,
            false
        );

        Wx_ProjectManager::add($projectContent);
        $add_informations = Wx_ProjectManager::getErrors();

        if(empty($add_informations)) {
            switch($projectContent->getType()) {
                case 'print3d':
                    header('Location:'.URL_PATH.'/project/'.$projectContent->getUrl().'/new');
                    break;
                default:
                    header('Location:'.URL_PATH.'/project/'.$projectContent->getUrl().'/view');
            }
        }
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

echo $twig->render('templates_pages/projects/content_newproject.twig', [
    'tab' => $tab,
    'breadcrum' => $breadcrum->getBreadcrum(),
    'value' => $value,
    'message' => $add_informations,
]);

Wx_Utils::showDebugInfos();