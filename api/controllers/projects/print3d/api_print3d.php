<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 01.03.2017
 */

require_once __DIR__.'/../../api_init.php';

Api_Authorization::requireAuthentication();

$app = Wx_Apps_Print3dManager::getId($_GET['id']);
$project = Wx_ProjectManager::getId($app->getProjectId());

$render = [
    'id' => $project->getId(),
    'name' => $project->getName(),
    'owner' => $project->getOwner(),
    'type' => $project->getType(),
    'description' => $project->getDescription(),
    'url' => $project->getUrl(),
    'date_creation' => $project->getDateCreation(),
    'date_modification' => $project->getDateModification(),
    'app' => [
        'id' => $app->getId(),
        'printer_id' => $app->getPrinterId(),
        'result_id' => $app->getResultId(),
        'timelapse_id' => $app->getTimelapseId(),
        'stl_id' => $app->getStlId(),
        'gcode_id' => $app->getGcodeId(),
        'infos' => $app->getInfos(),
    ]
];

Api_Render::render($render);
