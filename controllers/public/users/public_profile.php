<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 27.02.2017
 */

require_once __DIR__.'/../../init.php';

$options = Wx_OptionsManager::get(Wx_Session::getUser()->getId());


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