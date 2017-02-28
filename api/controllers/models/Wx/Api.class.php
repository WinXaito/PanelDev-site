<?php

/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 28.02.2017
 */
class Wx_Api{
    public static function render($array){
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        exit;
    }
}