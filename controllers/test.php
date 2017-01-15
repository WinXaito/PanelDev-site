<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 14.01.2017
 */

require_once __DIR__.'/init.php';

$projectManager = new Wx_ProjectManager($bdd, $_HistoricManager, $_User);
$projectContent = $projectManager->get('jeMadY');

var_dump($projectContent);

br();

$projectManager->getProjectUsers($projectContent->getId());







function br()
{
    echo '<br><br>----------<br><br>';
}