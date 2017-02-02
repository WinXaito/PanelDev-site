<?php

/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 01.02.2017
 */
class Wx_Utils{
    public static function showDebugInfos(){
        if(!DEBUG)
            return;

        $twigCache = TWIG_CACHE ? "Oui" : "Non";
        echo '
            <script>
                $("#debug_reqCount").text("'.Wx_Query::getCount().'");
                $("#debug_generationTime").text("'.round((microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"])*1000, 0).'");
                $("#debug_twigCache").text("'.$twigCache.'");
            </script>
        ';
    }
}