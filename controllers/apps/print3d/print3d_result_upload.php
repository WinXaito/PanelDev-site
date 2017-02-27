<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 26.02.2017
 */

if(isset($_FILES)) {
    if (isset($_FILES['resultFile']) && isset($_FILES['resultFile']['name']) && strlen($_FILES['resultFile']['name']) > 0) {
        if (Wx_Std_FilesManager::checkUploadFile($_FILES['resultFile'], FILES_APPS_PRINT3D_IMAGE_MAXSIZE)) {
            $file = new Wx_Std_File(
                0,
                null,
                $_FILES['resultFile']['name'],
                $_FILES['resultFile']['size'],
                '',
                $print3dContent->getId(),
                $print3dContent->getProjectId(),
                'image_result',
                '',
                time(),
                0
            );

            if (Wx_Std_FilesManager::upload($_User, $file, $_FILES['resultFile']['tmp_name'])) {
                $message['resultFile'] = 'Votre fichier a bien été uploadé';
            } else {
                $message['resultFile'] = 'Une erreur est survenu lors de l\'upload de votre fichier';
            }
        } else {
            $message['resultFile'] = 'Une erreur est survenu lors de la vérification de votre fichier';
        }
    }
}