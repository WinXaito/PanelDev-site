<?php

/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 02.02.2017
 */
class Wx_Std_FilesManager{
    /**
     * @param $url
     * @return null|Wx_Std_File
     */
    public static function get($url){
        $q = Wx_Query::query(
            '
                SELECT *   
                FROM std_files
                WHERE url = ?
            ',
            [
                $url,
            ]
        );
        $result = $q->fetch();

        if($result){
            $file = new Wx_Std_File(
                $result['id'],
                $result['name'],
                $result['description'],
                $result['parentType'],
                $result['parentId'],
                $result['type'],
                $result['url'],
                $result['date_creation'],
                $reuslt['date_modification']
            );

            return $file;
        }

        return null;
    }

    /**
     * @param Wx_Std_File $file
     */
    public static function add(Wx_Std_File $file){
        Wx_Query::query(
            '
                INSERT INTO std_files
                (name, description, parentType, parentId, type, url, date_creation)
                VALUES
                (:name, :description, :parentType, :parentId, :type, :url, :date_creation)
            ',
            [
                'name' => $file->getName(),
                'description' => $file->getDescription(),
                'parentType' => $file->getParentType(),
                'parentId' => $file->getParentId(),
                'type' => $file->getType(),
                'url' => $file->getUrl(),
                'date_creation' => time(),
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
                    description = :description,
                    parentType = :parentType,
                    parentId = :parentId,
                    type = :type,
                    url = :url
                    date_modification = :date_modification
                WHERE url = :urlfind
            ',
            [
                'name' => $file->getName(),
                'description' => $file->getDescription(),
                'parentType' => $file->getParentType(),
                'parentId' => $file->getParentId(),
                'type' => $file->getType(),
                'url' => $file->getUrl(),
                'urlfind' => $url,
                'date_modification' => time(),
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
                WHERE url = ?
            ',
            [
                $url,
            ]
        );
    }
}