<?php
    /**
     * Project: PanelDev
     * License: GPL3.0 ©All right reserved
     * User: WinXaito
     */

    require_once __DIR__.'/../../config.php';
?>

<header class="col-lg-12" style="height:85px;margin-bottom:10px">
	<div class="col-md-6">
		<h1>Panel de gestion</h1>
	</div>
	<div class="col-md-6 pull-right">
		<p class="text-right" style="margin-top:30px; margin-bottom:5px">
            <a href="<?php echo URL_PATH;?>/profile">Profile</a> | <a href="<?php echo URL_PATH;?>/logout">Déconnexion</a>
		</p>
        <p class="text-right">Connecté sous l'identifiant <strong style="color:#337AB7"><?php echo $_User->getName();?></strong></p>
	</div>
</header>
