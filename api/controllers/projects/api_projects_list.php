<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 04.03.2017
 */

require_once __DIR__.'/../api_init.php';

Api_Authorization::requireAuthentication();

if(!isset($_GET['username'])){
    $projects = Wx_ProjectManager::getAllProjects();
}else {
    $user = Wx_UserManager::getUserByName($_GET['username']);
    $projects = Wx_ProjectManager::getAllUserProjects($user);
}

$u = null;
foreach($projects as $project){
    /** @var $project Wx_Project */
    $u[] = [
        'id' => $project->getId(),
        'name' => $project->getName(),
        'url' => $project->getUrl(),
    ];
}

$render = [
    'count' => count($u),
    'projects' => $u,
];

Api_Render::render($render);