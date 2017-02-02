<?php
/**
 * Project: PanelDev
 * License: GPL3.0 ©All right reserved
 * User: WinXaito
 */

require_once __DIR__.'/../../init.php';

//Treatment
$add_informations = "";
$value = [];
if(isset($_GET['url']) && !empty($_GET['url'])) {
    if (isset($_POST['print3d_printer']) && isset($_POST['print3d_stl']) && isset($_POST['print3d_gcode']) && isset($_POST['print3d_infos'])) {
        $projectManager = new Wx_ProjectManager($_HistoricManager, $_User);
        $projectContent = $projectManager->get($_GET['url']);

        /* Todo
            Créer fonction "getAppPrint3d" et vérifier si le projet existe déjà dans la liste.
            S'il existe déjà, renvoyer une 404 ou 403 (Uniquement accessible avec l'url /update)
        */

        if($projectContent != null && $projectContent->getOwner() == $_User->getId()) {
            $value['printer'] = $_POST['print3d_printer'];
            $value['stl'] = $_POST['print3d_stl'];
            $value['gcode'] = $_POST['print3d_gcode'];
            $value['infos'] = $_POST['print3d_infos'];

            $print3dContent = new Wx_Apps_Print3d(
                0,
                $projectContent->getId(),
                0,
                0,
                0,
                0,
                0,
                $value['infos']
            );

            if(!$projectManager->addAppPrint3d($print3dContent))
                $add_informations .= '<p class="bg-primary message">Une erreur est survenu lors de l\'ajout dans la base de données</p>';
            else
                header('Location:'.URL_PATH.'/project/'.$_GET['url'].'/view');
        }else{
            $add_informations .= '<p class="bg-primary message">Le projet n\'a pas pu être récuperé</p>';
        }
    }
}else{
    $add_informations .= '<p class="bg-primary message">Une erreur est survenu</p>';
}


$breadcrum = new Wx_Breadcrum(
    true,
    [
        'Accueil' => '',
        'Projets' => '/projects',
        'Nouveau' => '/project/new',
        'Impression 3D' => '',
    ]
);
$tab['projects'] = "active";

echo $twig->render('templates_apps/print3d/print3d_new.twig', [
    'tab' => $tab,
    'breadcrum' => $breadcrum->getBreadcrum(),
    'value' => $value,
    'message' => $add_informations,
]);

Wx_Utils::showDebugInfos();