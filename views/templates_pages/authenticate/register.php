<?php
	/**
	 * Project: PanelDev
	 * License: GPL3.0 ©All right reserved
	 * User: WinXaito
	 */

	if(!isset($preset['username']))
		$preset['username'] = "";
	if(!isset($preset['email']))
		$preset['email'] = "";
	if(!isset($preset['password']))
		$preset['password'] = "";
	if(!isset($preset['confirmPassword']))
		$preset['confirmPassword'] = "";
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo URL_PATH;?>/assets/css/default.css"/>
		<link rel="stylesheet" href="<?php echo URL_PATH;?>/assets/libraries/css/bootstrap.css"/>
		<title>PanelDev - Inscription</title>
	</head>
	<body>
		<div class="container">
			<header>
				<h1>PanelDev</h1>
				<h2>Inscription</h2>
			</header>
			<section>
				<article class="col-lg-6 col-lg-offset-3">
					<form class="form col-md-12 center-block" method="POST" action="">
						<div class="form-group">
							<input class="form-control input-lg" placeholder="Identifiant" name="username" type="text" value="<?php echo $preset['username'];?>">
						</div>
						<div class="form-group">
							<input class="form-control input-lg" placeholder="Adresse email" name="email" type="text" value="<?php echo $preset['email'];?>">
						</div>
						<div class="form-group">
							<input class="form-control input-lg" placeholder="Mot de passe" name="password" type="password" value="<?php echo $preset['password'];?>">
						</div>
						<div class="form-group">
							<input class="form-control input-lg" placeholder="Confirmer le mot de passe" name="confirmPassword" type="password" value="<?php echo $preset['confirmPassword'];?>">
						</div>
						<div class="form-group">
							<button class="btn btn-primary btn-lg btn-block">Inscription</button>
							<span class="pull-right"><a href="<?php echo URL_PATH;?>/login">Connexion</a></span><span><a href="#">Besoin d'aide ?</a></span>
						</div>

						<?php echo $_add; ?>
					</form>
				</article>
			</section>
		</div>
	</body>
</html>

