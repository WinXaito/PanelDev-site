<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 04.03.2017
 */

require_once __DIR__.'/../api_init.php';

Api_Authorization::requireAuthentication();

$users = Wx_UserManager::getAllPublicUsers();

$u = null;
foreach($users as $user){
    /** @var $user Wx_User */
    $u[] = [
        'id' => $user->getId(),
        'name' => $user->getName(),
    ];
}

$render = [
    'count' => count($u),
    'users' => $u,
];

Api_Render::render($render);