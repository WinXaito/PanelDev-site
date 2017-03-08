<?php

/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 01.02.2017
 */
class Wx_Query{
    /** @var  $db PDO */
    private static $db;

    private static $count;
    private static $time;
    private static $total_time;

    /**
     * Init the Database connection
     */
    public static function init(){
        if(Wx_Query::$db == null) {
            self::$count = 0;
            self::$time = [];

            try {
                self::$db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
                self::$db->exec("SET CHARACTER SET utf8");
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
    }

    /**
     * @param $query
     * @param $params
     * @return PDOStatement
     */
    public static function query($query, $params){
        self::init();
        self::$count++;

        $tStart = microtime(true);
        $req = self::$db->prepare($query);

        //var_dump(debug_backtrace());
        foreach($params as $k => $v){
            if(filter_var($v, FILTER_VALIDATE_INT) || $v == 0)
                $req->bindValue($k, $v, PDO::PARAM_INT);
            else
                $req->bindValue($k, $v);
        }

        $req->execute();
        $tEnd = microtime(true);

        self::$time[self::$count] = [trim(preg_replace('/\s+/', ' ', $query)), $tEnd - $tStart];
        self::$total_time += $tEnd - $tStart;

        return $req;
    }

    /**
     * Used by paginQuery (For pagination, for use LIMIT)
     * @param $query
     * @param $time
     */
    public static function addQuery($query, $time){
        self::$count++;
        self::$time[self::$count] = [trim(preg_replace('/\s+/', ' ', $query)), $time];
        self::$total_time += $time;
    }

    /**
     * @return PDO
     */
    public static function getDb(){
        return self::$db;
    }

    /**
     * @return mixed
     */
    public static function getCount(){
        if(self::$count == null)
            return 0;

        return self::$count;
    }

    /**
     * @return mixed
     */
    public static function getTime(){
        return self::$time;
    }

    /**
     * @return mixed
     */
    public static function getTotalTime(){
        return self::$total_time;
    }
}