<?php
    /**
     * Project: paneldev
     * License: GPL3.0
     * User: WinXaito
     */

    return '
        <div class="sidebar">
		    <span><a href="'.URL_PATH.'/project/'.$projectContent->getUrl().'/view">Retour</a></span>
		</div>

        <h3 class="page-title">'.$projectContent->getName().'</h3>

        <div>
            <h4>Ajouter un utilisateur</h4>
            <form method="POST" action="">
                <div class="form-group">
                    <input type="text" name="username" class="form-control"/>
                </div>
                <div class="form-group text-center">
                    <input type="submit" value="Ajouter" class="btn btn-default"/>
                </div>

                '.$add_informations_useradd.'
            </form>
        </div>

        <div>
            <h4>Supprimer un utilisateur</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Identifiant</th>
                        <th>Suppression</th>
                    </tr>
                </thead>
                <tbody>
                    '.$projectContent->showUsersTable().'
                </tbody>
            </table>
        </div>
    ';