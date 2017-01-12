<?php
    /**
     * Project: paneldev
     * License: GPL3.0
     * User: WinXaito
     */

    require_once __DIR__.'/../init.php';
    require_once PATH.'/models/bdd.php';

    $optionsManager = new Wx_OptionsManager($bdd);
    $options = $optionsManager->get($_User->getId());


    $tab['options'] = "active";
    $breadcrum = new Wx_Breadcrum(
        false,
        [
            'Accueil' => URL_PATH_HOME,
            'Options' => '/options',
        ]
    );
    $complement['content'] = require_once PATH.'/views/templates_pages/options/options_content.php';

    require_once PATH.'/views/default.php';