<?php
    /**
     * Project: paneldev
     * License: GPL3.0 ©All right reserved
     * User: WinXaito
     */

    if(!isset($removing)){
        return '
            <div class="sidebar">
		        <span><a href="'.URL_PATH.'/project/'.$projectContent->getUrl().'/view">Retour</a></span>
		    </div>

            <h3 class="page-title">'.$projectContent->getName().'</h3>

            <div>
                <p class="alert alert-danger text-center">Attention, la suppression d\'un projet est définitif !</p>

                <form method="POST" action="" class="text-center">
                    <div class="form-group col-lg-6">
                        <input type="password" name="password" placeholder="Veuillez entrer votre mot de passe" class="form-control text-center"/>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-default" name="remove" value="Supprimer le projet"/>
                    </div>
                </form>
            </div>

            '.$add_informations.'
        ';
    }else{
        return '
            <p class="bg-success message">
                Le projet à été correctement supprimé<br/>
                <a href="'.URL_PATH.'/projects">Revenir à la liste des projets</a>
            </p>
        ';
    }