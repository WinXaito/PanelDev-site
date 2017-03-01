<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 26.02.2017
 */

require_once __DIR__.'/../../ajax_init.php';

if(isset($_GET['print3d_id']) && !empty($_GET['print3d_id'])){
    $print3dContent = Wx_Apps_Print3dManager::getId($_GET['print3d_id']);

    if($print3dContent != null){
        $project = Wx_ProjectManager::getId($print3dContent->getProjectId());

        if($project != null){
            if($project->getOwner() == Wx_Session::getUser()->getId()){
                $gcodeFiles = Wx_Std_FilesManager::getProjectFiles($print3dContent);
                $files = [];
                foreach($gcodeFiles as $file){
                    /** @var $file Wx_Std_File */
                    if($file->getType() == 'gcode') {
                        array_push(
                            $files,
                            [
                                'id' => $file->getId(),
                                'name' => $file->getName(),
                                'description' => $file->getDescription(),
                                'content' => file(__DIR__.'/../../../media/users/'.Wx_Session::getUser()->getId().'/projects/'.$project->getId().'/files/'.$file->getUniqId().'.wx')
                            ]
                        );
                    }
                }

                Wx_Ajax::render([
                    'status' => 'ok',
                    'code' => 0,
                    'files' => $files,
                ]);
            }else{
                Wx_Errors::setAndShowErrorAjax(403);
            }
        }else{
            Wx_Errors::setAndShowErrorAjax(500);
        }
    }else{
        Wx_Errors::setAndShowErrorAjax(404);
    }
}else{
    Wx_Errors::setAndShowErrorAjax(500);
}