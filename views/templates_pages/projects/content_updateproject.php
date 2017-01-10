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

        <form method="POST" action="">
            <div class="form-group">
                <input type="text" class="form-control" name="project_name" placeholder="Titre du projet" value="'.$projectContent->getName().'"/>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="project_description">'.$projectContent->getDescription().'</textarea>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="project_url" placeholder="Url" value="'.$projectContent->getUrlProject().'"/>
            </div>
            <div class="form-group text-center">
                <input type="submit" class="btn btn-default" name="submit" value="Appliquer les modifications"/>
            </div>
        </form>

        '.$add_informations.'
    ';