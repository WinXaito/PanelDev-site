<?php

/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 02.02.2017
 */
class Wx_Std_FilesManager{
    /**
     * @param $uniqId
     * @return null|Wx_Std_File
     */
    public static function get($uniqId){
        $q = Wx_Query::query(
            '
                SELECT *   
                FROM std_files
                WHERE uniqId = :id
            ',
            [
                'id' => $uniqId,
            ]
        );
        $result = $q->fetch();

        if($result){
            $file = new Wx_Std_File(
                $result['id'],
                $result['uniqId'],
                $result['name'],
                $result['size'],
                $result['description'],
                $result['parentId'],
                $result['projectId'],
                $result['type'],
                $result['url'],
                $result['date_creation'],
                $result['date_modification'],
                $result['public']
            );

            return $file;
        }

        return null;
    }

    /**
     * @param Wx_Apps_iApps $project
     * @return array
     */
    public static function getProjectFiles(Wx_Apps_iApps $project){
        $q = Wx_Query::query(
            '
                SELECT *
                FROM std_files
                WHERE projectId = :projectId
            ',
            [
                'projectId' => $project->getProjectId(),
            ]
        );

        $result = [];
        while($data = $q->fetch()){
            array_push(
                $result,
                new Wx_Std_File(
                    $data['id'],
                    $data['uniqId'],
                    $data['name'],
                    $data['size'],
                    $data['description'],
                    $data['parentId'],
                    $data['projectId'],
                    $data['type'],
                    $data['url'],
                    $data['date_creation'],
                    $data['date_modification'],
                    $data['public']
                )
            );
        }

        return $result;
    }

    /**
     * @param Wx_Std_File $file
     */
    public static function add(Wx_Std_File $file){
        Wx_Query::query(
            '
                INSERT INTO std_files
                (uniqId, name, size, description, parentType, parentId, projectId, type, url, date_creation, date_modification, public)
                VALUES
                (:uniqId, :name, :size, :description, :parentType, :parentId, :projectId, :type, :url, :date_creation, :date_modification, :public)
            ',
            [
                'uniqId' => $file->getUniqId(),
                'name' => $file->getName(),
                'size' => $file->getSize(),
                'description' => $file->getDescription(),
                'parentType' => $file->getParent()->getType(),
                'parentId' => $file->getParent()->getId(),
                'projectId' => $file->getParent()->getProjectId(),
                'type' => $file->getType(),
                'url' => $file->getUrl(),
                'date_creation' => time(),
                'date_modification' => 0,
                'public' => $file->isPublic(),
            ]
        );
    }

    /**
     * @param Wx_Std_File $file
     * @param $url
     */
    public static function update(Wx_Std_File $file, $url){
        Wx_Query::query(
            '
                UPDATE std_files
                SET name = :name,
                    size = :size, 
                    description = :description,
                    parentType = :parentType,
                    parentId = :parentId,
                    type = :type,
                    url = :url,
                    date_modification = :date_modification,
                    public = :public
                WHERE url = :urlfind
            ',
            [
                'name' => $file->getName(),
                'size' => $file->getSize(),
                'description' => $file->getDescription(),
                'parentType' => $file->getParent()->getType(),
                'parentId' => $file->getParent()->getId(),
                'type' => $file->getType(),
                'url' => $file->getUrl(),
                'urlfind' => $url,
                'date_modification' => time(),
                'public' => $file->isPublic(),
            ]
        );
    }

    /**
     * @param $url
     */
    public static function remove($url){
        Wx_Query::query(
            '
                DELETE FROM std_files
                WHERE url = :url
            ',
            [
                'url' => $url,
            ]
        );
    }

    /**
     * @param Wx_User $user
     * @param Wx_Std_File $file
     * @param $tmpName
     * @return bool
     * @internal param Wx_Project $project
     */
    public static function upload(Wx_User $user, Wx_Std_File $file, $tmpName){
        $path = __DIR__.'/../../../media/users/'.$user->getId().'/projects/'.$file->getProjectId().'/files';

        if(!file_exists($path))
            if(!mkdir($path, 0777, true))
                return false;

        if(move_uploaded_file($tmpName, $path.'/'.$file->getUniqId().'.wx')){
            self::add($file);
            return true;
        }

        return false;
    }

    /**
     * @param $file
     * @param $maxsize
     * @return bool
     */
    public static function checkUploadFile($file, $maxsize){
        if(isset($file['name'], $file['type'], $file['tmp_name'], $file['error'], $file['size']) &&
            $file['error'] == 0 &&
            $file['size'] < $maxsize){
            return true;
        }

        return false;
    }
}