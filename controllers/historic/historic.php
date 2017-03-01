<?php
/**
 * Project: paneldev
 * License: GPL3.0
 * User: WinXaito
 */

require_once __DIR__.'/../init.php';

$historic = Wx_HistoricManager::getAllHistoric();

$tab['historic'] = "active";
$breadcrum = new Wx_Breadcrum(
    false,
    [
        'Accueil' => '',
        'Historique' => 'historic',
    ]
);

echo $twig->render('templates_pages/historic/content_historic.twig', [
    'tab' => $tab,
    'breadcrum' => $breadcrum->getBreadcrum(),
    'historic' => $historic,
]);

Wx_Utils::showDebugInfos();