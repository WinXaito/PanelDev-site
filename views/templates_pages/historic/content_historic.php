<?php
    /**
     * Project: paneldev
     * License: GPL3.0
     * User: WinXaito
     */

    return '
        <div class="sidebar">
            <span><a href="'.URL_PATH.'/historic/desactive">Désactiver</a></span>
            <span><a href="'.URL_PATH.'/historic/remove">Supprimer</a></span>
        </div>

        <h3 class="page-title">Historique</h3>

        '.$historicManager->showAllHistoricTable().'
    ';