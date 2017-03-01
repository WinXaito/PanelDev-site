<?php
/**
 * Project: paneldev
 * License: GPL3.0
 * User: WinXaito
 */

require_once __DIR__.'/../init.php';

$options = Wx_OptionsManager::get($_User->getId());


$tab['options'] = "active";
$breadcrum = new Wx_Breadcrum(
    false,
    [
        'Accueil' => '',
        'Options' => 'options',
    ]
);

echo $twig->render('templates_pages/options/content_options.twig', [
    'tab' => $tab,
    'breadcrum' => $breadcrum->getBreadcrum(),
]);

Wx_Utils::showDebugInfos();