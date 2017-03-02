<?php
/**
 * Project: PanelDev
 * License: GPL3.0 ©All right reserved
 * User: WinXaito
 */

require_once __DIR__.'/../private_init.php';

$tab['help'] = "active";
$breadcrum = new Wx_Breadcrum(
    false,
    [
        'Accueil' => '',
        'Aide' => 'help'
    ]
);

echo $twig->render('templates_pages/help/content_help.twig', [
    'breadcrum' => $breadcrum->getBreadcrum(),
    'tab' => $tab,
]);

Wx_Utils::showDebugInfos();