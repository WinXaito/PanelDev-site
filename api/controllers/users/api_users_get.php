<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 01.03.2017
 */

require_once __DIR__.'/../api_init.php';

Api_Authorization::requireAuthentication();

$user_mgr = new Wx_UserManager();
$user = $user_mgr->getUserById($_GET['id']);

$render = [
    'id' => $user->getId(),
    'name' => $user->getName(),
    'email' => $user->getEmail(),
    'firstname' => $user->getFirstName(),
    'lastname' => $user->getLastName(),
    'grade' => $user->getGrade(),
];

Api_Render::render($render);