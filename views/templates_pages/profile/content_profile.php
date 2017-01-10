<?php
	/**
	 * Project: PanelDev
	 * License: GPL3.0 ©All right reserved
	 * User: WinXaito
	 */

	return '
		<div>
        	<h3 class="page-title">Profile - '.$_User->getName().'</h3>

            <form method="POST" action="">
                <div class="form-group">
                    <input type="text" name="profile_username" class="form-control" readonly  placeholder="Nom d\'utilisateur" value="'.$_User->getName().'"/>
                </div>
                <div class="form-group">
                    <input type="text" name="profile_email" class="form-control" placeholder="Adresse email" value="'.$_User->getEmail().'"/>
                </div>
                <div class="form-group">
                    <input type="password" name="profile_password" class="form-control" placeholder="Mot de passe (Laissez vide pour ne pas modifier)"/>
                </div>
                <div class="form-group">
                    <input type="password" name="profile_passwordConfirm" class="form-control" placeholder="Confirmation du mot de passe (Laissez vide pour ne pas modifier)"/>
                </div>
                <div class="form-group">
                    <input type="text" name="profile_firstname" class="form-control" placeholder="Prénom" value="'.$_User->getFirstName().'"/>
                </div>
                <div class="form-group">
                    <input type="text" name="profile_lastname" class="form-control" placeholder="Nom" value="'.$_User->getLastName().'"/>
                </div>

                <div class="form-group text-center">
                    <input type="submit" value="Mettre à jour mon profil" class="btn btn-default"/>
                </div>
            </form>

            '.$_add.'
		</div>
	';