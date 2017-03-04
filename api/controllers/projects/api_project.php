<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 04.03.2017
 */

require_once __DIR__.'/../api_init.php';

Api_Authorization::requireAuthentication();

$project = Wx_ProjectManager::get($_GET['url']);

if($project == null)
    Api_Render::error(404);

switch($project->getType()){
    case 'print3d':
        $app = Wx_Apps_Print3dManager::getId($project->getAppId());
        $app = [
            'id' => $app->getId(),
            'printer_id' => $app->getPrinterId(),
            'result_id' => $app->getResultId(),
            'timelapse_id' => $app->getTimelapseId(),
            'stl_id' => $app->getStlId(),
            'gcode_id' => $app->getGcodeId(),
            'infos' => $app->getInfos(),
        ];
        break;
    default:
        $app = [
            //TODO: Dynamical error
            'code' => 1000,
            'message' => 'Application not supported',
        ];
}

$render = [
    'id' => $project->getId(),
    'name' => $project->getName(),
    'owner' => $project->getOwner(),
    'type' => $project->getType(),
    'description' => $project->getDescription(),
    'url' => $project->getUrl(),
    'date_creation' => $project->getDateCreation(),
    'date_modification' => $project->getDateModification(),
    'app' => $app,
];

Api_Render::render($render);
