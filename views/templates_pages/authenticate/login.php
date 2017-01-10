<?php
	/**
	 * Project: PanelDev
	 * License: GPL3.0 ©All right reserved
	 * User: WinXaito
	 */
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo URL_PATH;?>/assets/css/default.css"/>
		<link rel="stylesheet" href="<?php echo URL_PATH;?>/assets/libraries/css/bootstrap.css"/>
		<title>PanelDev - Authentification</title>
	</head>
	<body>
		<div class="container">
			<header>
				<h1>PanelDev</h1>
				<h2>Connexion</h2>
			</header>
			<section>
				<article class="col-lg-4 col-lg-offset-4">
					<form class="form col-md-12 center-block" method="POST" action="">
						<div class="form-group">
							<input class="form-control input-lg" placeholder="Identifiant" name="username" type="text">
						</div>
						<div class="form-group">
							<input class="form-control input-lg" placeholder="Mot de passe" name="password" type="password">
						</div>
						<div class="form-group">
							<button class="btn btn-primary btn-lg btn-block">Connexion</button>
							<span class="pull-right"><a href="<?php echo URL_PATH;?>/register">Inscription</a></span><span><a href="#">Besoin d'aide ?</a></span>
						</div>

						<?php echo $_add; ?>
					</form>
				</article>
			</section>
		</div>
	</body>
</html>
