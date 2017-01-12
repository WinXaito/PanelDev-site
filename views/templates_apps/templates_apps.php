<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 12.01.2017
 */

require_once __DIR__.'/../../controllers/init.php';

if(!isset($error))
    $error = new Errors();

if(!isset($projectContent) || !isset($_User))
    $error->setAndShowError(500);