<?php

/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 01.03.2017
 */
class Wx_Session{
    /** @var Wx_User $user */
    private static $user = null;

    /**
     * @param Wx_User $user
     */
    public static function init(Wx_User $user){
        self::$user = $user;
    }

    /**
     * @return bool
     */
    public static function isAuthenticated(){
        return self::$user != null;
    }

    /**
     * @return Wx_User
     */
    public static function getUser(){
        return self::$user;
    }

    public static function destroy(){
        self::$user = null;
    }
}