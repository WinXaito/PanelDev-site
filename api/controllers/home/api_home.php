<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 28.02.2017
 */

require_once __DIR__.'/../api_init.php';

$render = [
    'status' => 'ok',
    'title' => 'ProjectsManager API',
    'version' => '0.0.1',
    'version_name' => 'Bêta 0.0.1',
];

Api_Render::render($render);