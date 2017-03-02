<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 02.02.2017
 */

require_once __DIR__.'/../public_init.php';

$errorCode = isset($_GET['error']) ? $_GET['error'] : 0;
$_Error->setAndShowError($_GET['error']);