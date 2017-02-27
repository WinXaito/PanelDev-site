<?php

/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 08.02.2017
 */
class Wx_Apps_Print3dManager{
    public static function get(Wx_Project $project){
        $q = Wx_Query::query(
            "
                SELECT *
                FROM app_print3d
                WHERE project_id = ?
            ",
            [
                $project->getId(),
            ]
        );

        $data = $q->fetch();

        if($data != null){
            return new Wx_Apps_Print3d(
                $data['id'],
                $data['project_id'],
                $data['printer_id'],
                $data['result_id'],
                $data['timelapse_id'],
                $data['stl_id'],
                $data['gcode_id'],
                $data['infos']
            );
        }else{
            return null;
        }
    }

    public static function getId($print3d_id){
        $q = Wx_Query::query(
            "
                SELECT *
                FROM app_print3d
                WHERE id = ?
            ",
            [
                $print3d_id,
            ]
        );

        $data = $q->fetch();

        if($data != null){
            return new Wx_Apps_Print3d(
                $data['id'],
                $data['project_id'],
                $data['printer_id'],
                $data['result_id'],
                $data['timelapse_id'],
                $data['stl_id'],
                $data['gcode_id'],
                $data['infos']
            );
        }else{
            return null;
        }
    }

    public static function update(Wx_Apps_Print3d $project){
        $q = Wx_Query::query(
            '
                UPDATE app_print3d
                SET project_id = :project_id,
                    printer_id = :printer_id,
                    result_id = :result_id,
                    timelapse_id = :timelapse_id,
                    stl_id = :stl_id,
                    gcode_id = :gcode_id,
                    infos = :infos
                WHERE id = :id
            ',
            [
                'id' => $project->getId(),
                'project_id' => $project->getProjectId(),
                'printer_id' => $project->getPrinterId(),
                'result_id' => $project->getResultId(),
                'timelapse_id' => $project->getTimelapseId(),
                'stl_id' => $project->getStlId(),
                'gcode_id' => $project->getGcodeId(),
                'infos' => $project->getInfos(),
            ]
        );

        return $q->errorCode() == 0 ? true : false;
    }

    public static function remove(Wx_Apps_Print3d $project){
        Wx_Query::query(
            '
                DELETE FROM app_print3d
                WHERE id = ?
            ',
            [
                $project->getId()
            ]
        );
    }
}