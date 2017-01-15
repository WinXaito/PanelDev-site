<?php
    /**
     * Project: paneldev
     * License: GPL3.0
     * User: WinXaito
     */

    require_once __DIR__.'/../init.php';

    $historicManager = new Wx_HistoricManager($bdd, $_User);
    $historic = $historicManager->getAllHistoric();

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