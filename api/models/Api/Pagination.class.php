<?php

/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 04.03.2017
 */
class Api_Pagination{
    private static $numberRows;

    /**
     * @param $request
     * @param $params
     * @param $page
     * @return array|null
     */
    public static function pagin($request, $params, $page){
        $offset = ($page - 1) * API_PAGINATION_NUMBER;
        $limit = $offset + API_PAGINATION_NUMBER;

        $q = Wx_Query::query(
            "
                SELECT SQL_CALC_FOUND_ROWS *
                FROM projects
                LIMIT :limit
                OFFSET :offset
            ",
            [
                'limit' => $limit,
                'offset' => $offset,
            ]
        );

        $reqFoundRows = Wx_Query::query('SELECT found_rows()', []);
        self::$numberRows = $reqFoundRows->fetchColumn();

        $return = null;
        while($data = $q->fetch()){
            $return[] = new Wx_Project(
                $data['app_id'],
                $data['name'],
                $data['owner'],
                $data['type'],
                $data['description'],
                $data['url'],
                $data['date_creation'],
                $data['date_modification'],
                $data['public'],
                $data['id']
            );
        }

        return $return;
    }

    /**
     * @return mixed
     */
    public static function getNumberRows(){
        return self::$numberRows;
    }
}