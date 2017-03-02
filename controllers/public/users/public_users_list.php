<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 02.03.2017
 */

require_once __DIR__.'/../../init.php';

$users = Wx_UserManager::getAllPublicUsers();


$tab['users'] = 'active';

$breadcrum = new Wx_Breadcrum(
    false,
    [
        'Accueil' => '',
        'Utilisateurs' => '',
    ]
);

echo $twig->render('templates_pages/public/users/public_users_list.twig', [
    'tab' => $tab,
    'breadcrum' => $breadcrum->getBreadcrum(),
    'users' => $users,
]);

Wx_Utils::showDebugInfos();