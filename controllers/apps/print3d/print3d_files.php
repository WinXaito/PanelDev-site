<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 21.02.2017
 */

$files = Wx_Std_FilesManager::getProjectFiles($print3dContent);

echo $twig->render($template, [
    'tab' => $tab,
    'breadcrum' => $breadcrum->getBreadcrum(),
    'project' => $projectContent,
    'print3d' => $print3dContent,
    'files' => $files,
    'message' => $message,
]);