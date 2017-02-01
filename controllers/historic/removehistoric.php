<?php
    /**
     * Project: paneldev
     * License: GPL3.0
     * User: WinXaito
     */

    require_once __DIR__.'/../init.php';

    $historicManager = new Wx_HistoricManager($bdd, $_User);

    $tab['historic'] = "active";
    $breadcrum = new Wx_Breadcrum(
        false,
        [
            'Accueil' => '',
            'Historique' => 'historic',
            'Suppression' => '/remove',
        ]
    );
    $complement['content'] = require_once PATH.'/views/templates_pages/historic/content_removehistoric.php';

    echo $twig->render('templates_pages/historic/content_removehistoric.twig', [
        'tab' => $tab,
        'breadcrum' => $breadcrum->getBreadcrum(),
    ]);

    Wx_Utils::showDebugInfos();