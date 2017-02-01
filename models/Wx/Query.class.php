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
        $req->execute($params);
        $tEnd = microtime(true);

        self::$time[self::$count] = [$query, $tEnd - $tStart];

        return $req;
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
}