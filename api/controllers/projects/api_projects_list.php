<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 04.03.2017
 */

require_once __DIR__.'/../api_init.php';

Api_Authorization::requireAuthentication();

$current_page = 1;
if(!isset($_GET['username'])){
    //$projects = Wx_ProjectManager::getAllProjects();
    $projects = Api_Pagination::pagin('', [], $current_page);
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

$number_page = ceil(Api_Pagination::getNumberRows() / API_PAGINATION_NUMBER);


$previous_page = 'None';
$next_page = 'None';

if($current_page > 1)
    $previous_page = $current_page - 1;
if($current_page < $number_page)
$next_page = $current_page + 1;

$render = [
    'number_page' => $number_page,
    '_links' => [
        'previous' => $previous_page,
        'next' => $next_page,
    ],
    'count' => count($u),
    'projects' => $u,
];

Api_Render::render($render);