<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 12.01.2017
 */

require_once __DIR__.'/../templates_apps.php';

return '
    <div class="sidebar">
        <span><a href="'.URL_PATH.'/project/'.$projectContent->getUrl().'/update">Modifier</a></span>
        <span><a href="'.URL_PATH.'/project/'.$projectContent->getUrl().'/view/documentation">Documentation</a></span>
        <span><a href="'.URL_PATH.'/project/'.$projectContent->getUrl().'/view/analytics">Analyse</a></span>
        <span><a href="'.URL_PATH.'/project/'.$projectContent->getUrl().'/view/users">Utilisateurs</a></span>
        <span class="pull-right" style="display:inline-block"><a href="'.URL_PATH.'/project/'.$projectContent->getUrl().'/remove">Supprimer</a></span>
    </div>

    <h3 class="page-title">'.$projectContent->getName().'
        <span class="pull-right">
            <a href="'.$projectContent->getUrlProject().'" class="btn btn-default btn-accessproject">Accéder au projet</a>
        </span></h3>
    <div>
        <p>'.$projectContent->getDescription().'</p>
    </div>
';