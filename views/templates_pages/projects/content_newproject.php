<?php
	/**
	 * Project: PanelDev
	 * License: GPL3.0 ©All right reserved
	 * User: WinXaito
	 */

	if(!isset($value__project_name))
		$value__project_name = "";
	if(!isset($value__project_description))
		$value__project_description = "";
	if(!isset($value__project_url))
		$value__project_url = "";
	if(!isset($add_informations))
		$add_informations = "";

	return '
		<form action="" method="POST">
			<div class="form-group">
			    <select name="project_type" class="form-control" style="margin-bottom:10px">
			        <option value="general" selected>Générale</option>
			        <option value="website">Site web</option>
			        <option value="game">Jeu vidéo</option>
			        <option value="general-idea">Idée générale</option>
                </select>
				<input type="text" name="project_name" placeholder="Nom du projet" class="form-control" style="margin-bottom:10px" value="'.$value__project_name.'"/>
				<textarea name="project_description" placeholder="Description du projet (optionnel)" class="form-control" style="margin-bottom:10px">'.$value__project_description.'</textarea>
				<input type="text" name="project_url" placeholder="Url du projet" class="form-control" style="margin-bottom:10px" value="'.$value__project_url.'"/>
			</div>
			<div class="form-group text-center">
				<input type="submit" class="btn btn-default" value="Créer le projet" name="submit"/>
			</div>
		</form>
		<div>
			'.$add_informations.'
		</div>
	';