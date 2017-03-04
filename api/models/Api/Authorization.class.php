<?php

/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 28.02.2017
 */
class Api_Authorization{
    public static function requireAuthentication(){
        //TODO: API Authentication
        return;

        if(!Wx_Session::isAuthenticated())
            Api_Render::error(401);
    }
}