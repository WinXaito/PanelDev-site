<?php
/**
 * Project: PanelDev
 * License: GPL3.0 ©All right reserved
 * User: WinXaito
 */

require_once __DIR__.'/../public_init.php';

Wx_Session::getUser()->deconnect();
header('Location:'.URL_PATH.'/login');