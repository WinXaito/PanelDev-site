<?php
    /**
     * Project: PanelDev
     * User: WinXaito
     */

    require_once __DIR__.'/../../config.php';
    require_once PATH.'/controllers/init.php';
?>

<aside class="col-md-2">
	<ul class="nav nav-pills nav-stacked">
		<li class="<?php echo $tab['home'];?>"><a href="<?php echo URL_PATH; ?>/">Accueil</a></li>
		<li class="<?php echo $tab['projects'];?>"><a href="<?php echo URL_PATH; ?>/projects">Gestion projets</a></li>
		<!--<li class="<?php echo $tab['cloud'];?>"><a href="<?php echo URL_PATH; ?>">Cloud</a></li>-->
		<li class="<?php echo $tab['options'];?>"><a href="<?php echo URL_PATH; ?>/options">Options</a></li>
        <li class="<?php echo $tab['historic'];?>"><a href="<?php echo URL_PATH; ?>/historic">Historique</a></li>
        <li class="<?php echo $tab['help'];?>"><a href="<?php echo URL_PATH; ?>/help">Aide</a></li>
        <?php if($_User->isAdministrator()){ ?>
            <li class="<?php ;?>"><a href="<?php echo URL_PATH; ?>/administrator">Administration</a></li>
        <?php } ?>
	</ul>
</aside>
