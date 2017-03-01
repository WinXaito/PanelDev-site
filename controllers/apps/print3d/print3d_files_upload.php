<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 15.02.2017
 */

if(isset($_FILES)){
    if(isset($_FILES['stlFile']) && isset($_FILES['stlFile']['name']) && strlen($_FILES['stlFile']['name']) > 0){
        if(Wx_Std_FilesManager::checkUploadFile($_FILES['stlFile'], FILES_APPS_PRINT3D_STL_MAXSIZE)){
            $file = new Wx_Std_File(
                0,
                null,
                $_FILES['stlFile']['name'],
                $_FILES['stlFile']['size'],
                '',
                $print3dContent->getId(),
                $print3dContent->getProjectId(),
                'stl',
                '',
                time(),
                0
            );

            if(Wx_Std_FilesManager::upload(Wx_Session::getUser(), $file, $_FILES['stlFile']['tmp_name'])){
                $message['stlFile'] = 'Votre fichier a bien été uploadé';
            }else{
                $message['stlFile'] = 'Une erreur est survenu lors de l\'upload de votre fichier';
            }
        }else{
            $message['stlFile'] = 'Une erreur est survenu lors de la vérification de votre fichier';
        }
    }

    if(isset($_FILES['gCodeFile']) && isset($_FILES['gCodeFile']['name']) && strlen($_FILES['gCodeFile']['name']) > 0){
        if(Wx_Std_FilesManager::checkUploadFile($_FILES['gCodeFile'], FILES_APPS_PRINT3D_STL_MAXSIZE)){
            $file = new Wx_Std_File(
                0,
                null,
                $_FILES['gCodeFile']['name'],
                $_FILES['gCodeFile']['size'],
                '',
                $print3dContent,
                'gcode',
                '',
                time(),
                0
            );

            if(Wx_Std_FilesManager::upload(Wx_Session::getUser(), $file, $_FILES['gCodeFile']['tmp_name'])){
                $message['gCodeFile'] = 'Votre fichier a bien été uploadé';
            }else{
                $message['gCodeFile'] = 'Une erreur est survenu lors de l\'upload de votre fichier';
            }
        }else{
            $message['gCodeFile'] = 'Une erreur est survenu lors de la vérification de votre fichier';
        }
    }

    if(isset($_FILES['otherFiles'])){
        /*TODO : CHECK
         && isset($_FILES['otherFiles']['name']) && strlen($_FILES['otherFiles']['name']) > 0
        if(Wx_Std_FilesManager::checkUploadFile($_FILES['otherFiles'], FILES_APPS_PRINT3D_STL_MAXSIZE)){
            for($i = 0;$i < count($_FILES['otherFiles']['name']);$i++){
                if(Wx_Std_FilesManager::upload($_FILES['otherFiles'])){
                    $message['gCodeFile'] = 'Votre fichier '.$.' a bien été uploadé';
                }else{
                    //UPLOAD ERROR
                }
            }
        }else{
            //ERROR
        }*/
    }
}