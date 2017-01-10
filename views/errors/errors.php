<?php
	/**
	 * Project: PanelDev
	 * License: GPL3.0 ©All right reserved
	 * User: WinXaito
	 */

    require_once __DIR__.'/../../config.php';
    require_once PATH.'/views/errors/headers.php';


	if(isset($_GET['error'])){
        switch($_GET['error']){
            case 400:
                $error_title = E400_title;
                $error_content = E400_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E400_header);
                break;
            case 401:
                $error_title = E401_title;
                $error_content = E401_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E401_header);
                break;
            case 402:
                $error_title = E402_title;
                $error_content = E402_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E402_header);
                break;
            case 403:
                $error_title = E403_title;
                $error_content = E403_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E403_header);
                break;
            case 404:
                $error_title = E404_title;
                $error_content = E404_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E404_header);
                break;
            case 500:
                $error_title = E500_title;
                $error_content = E500_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E500_header);
                break;
            default:
                $error_title = "Erreur inconnu";
                $error_content = "Une erreur inconnu est survenu";
        }
    }else{
        $error_title = "Erreur inconnu";
        $error_content = "Une erreur inconnu est survenu";
    }
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URL_PATH;?>/assets/libraries/css/bootstrap.css"/>
    <title>PanelDev - Erreur</title>
</head>
<body>
<div class="container">
    <header>
        <h1><a href="<?php echo URL_PATH_HOME;?>">PanelDev</a></h1>
        <h2>Erreur</h2>
    </header>
    <section>
        <article class="text-center">
            <h3><?php echo $error_title;?></h3>
            <p><?php echo $error_content;?></p>
        </article>
    </section>
</div>
</body>
</html>
