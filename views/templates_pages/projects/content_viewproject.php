<?php
    /**
     * Project: paneldev
     * License: GPL3.0 ©All right reserved
     * User: WinXaito
     */

    return '
        <div class="sidebar">
		    <span><a href="'.URL_PATH.'/project/'.$projectContent->getUrl().'/update">Modifier</a></span>
		    <span><a href="'.URL_PATH.'/project/'.$projectContent->getUrl().'/view/documentation">Documentation</a></span>
		    <span><a href="'.URL_PATH.'/project/'.$projectContent->getUrl().'/view/analytics">Analyse</a></span>
		    <span><a href="'.URL_PATH.'/project/'.$projectContent->getUrl().'/view/users">Utilisateurs</a></span>
		    <span class="pull-right" style="display:inline-block"><a href="'.URL_PATH.'/project/'.$projectContent->getUrl().'/remove">Supprimer</a></span>
		</div>

		<h3 class="page-title">'.$projectContent->getName().'<span class="pull-right"><a href="'.$projectContent->getUrlProject().'" class="btn btn-default btn-accessproject">Accéder au projet</a></span></h3>
		<div>
		    <p>'.$projectContent->getDescription().'</p>
		</div>

        <div class="col-md-6 viewproject-block">
            <h4 class="text-center"><a href="'.URL_PATH.'/project/'.$projectContent->getUrl().'/view/analytics">Analyse</a></h4>
            <p>Analyse content</p>
        </div>
        <div class="col-md-6 viewproject-block">
            <h4 class="text-center"><a href="'.URL_PATH.'/project/'.$projectContent->getUrl().'/view/users">Utilisateur</a></h4>
            <table class="table table-striped">
                <tbody>
                    <tr class="alert-info">
                        <td>'.$_User->getName().'</td>
                        <td>Administrateur</td>
                    </tr>
                    '.$projectContent->showUsersTable().'
                </tbody>
            </table>
        </div>
	';