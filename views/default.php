<?php
    /**
     * Project: PanelDev
     * License: GPL3.0 ©All right reserved
     * User: WinXaito
     */

    require_once __DIR__.'/../config.php';

    if(!isset($complement['content']))
        $complement['content'] = 'Error, invalid content';
    if(!isset($complement['css']))
        $complement['css'] = '';
    if(!isset($complement['js']))
        $complement['js'] = '';

    if(!isset($breadcrum))
        $breadcrum = "";
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo URL_PATH;?>/assets/css/default.css"/>
        <link rel="stylesheet" href="<?php echo URL_PATH;?>/assets/libraries/css/bootstrap.css"/>
        <?php echo $complement['css']; ?>
        <title>Espace développement</title>
    </head>
    <body>
        <div class="container">
            <?php require_once __DIR__.'/templates/header.php'; ?>
            <section class="col-lg-12">
                <?php require_once __DIR__.'/templates/navigation.php'; ?>
                <article class="col-md-10">
                    <?php echo $breadcrum->show();?>
                    <?php echo $complement['content'];?>
                </article>
            </section>
        </div>
    </body>

    <?php echo $complement['js']; ?>
</html>
