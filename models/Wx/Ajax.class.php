<?php

/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 26.02.2017
 */
class Wx_Ajax{
    public static function render(Array $arr){
        echo  json_encode($arr, JSON_UNESCAPED_UNICODE);
        exit();
    }
}