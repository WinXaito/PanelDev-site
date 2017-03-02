<?php
/**
 * Project: paneldev
 * License: GPL3.0
 * User: WinXaito
 */

require_once __DIR__.'/../private_init.php';

$tab['historic'] = "active";
$breadcrum = new Wx_Breadcrum(
    false,
    [
        'Accueil' => '',
        'Historique' => 'historic',
        'Suppression' => '/remove',
    ]
);

echo $twig->render('templates_pages/historic/content_removehistoric.twig', [
    'tab' => $tab,
    'breadcrum' => $breadcrum->getBreadcrum(),
]);

Wx_Utils::showDebugInfos();