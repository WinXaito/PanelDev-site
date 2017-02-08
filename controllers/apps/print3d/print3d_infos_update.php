<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 08.02.2017
 */

if(isset($_POST['submit']) && isset($_POST['infos'])){
    $print3dContent->setInfos($_POST['infos']);
    if(Wx_Apps_Print3dManager::update($print3dContent))
        $message = 'Ces informations ont été mise à jour';
    else
        $message = 'Une erreur est survenu lors de l\'ajout dans la base de données';
}