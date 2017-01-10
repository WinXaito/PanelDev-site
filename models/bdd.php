<?php
	/**
	 * Project: PanelDev
	 * License: GPL3.0 ©All right reserved
	 * User: WinXaito
	 */

	require_once __DIR__.'/../config.php';

	try{
		$bdd = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD);
		$bdd->exec("SET CHARACTER SET utf8");
	}catch(Exception $e){
		die('Erreur : '.$e->getMessage());
	}