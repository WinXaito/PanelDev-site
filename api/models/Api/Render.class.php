<?php

/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 28.02.2017
 */
class Api_Render{
    public static function render($array){
        if(API_DEBUG)
            $array['debug'] = self::debug();

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        exit;
    }

    public static function error($error, $title=null, $content=null){
        require_once __DIR__.'/../../../controllers/errors/errors_headers.php';

        switch($error){
            case 400:
                $_error_title = E400_title;
                $_error_content = E400_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E400_header);
                break;
            case 401:
                $_error_title = E401_title;
                $_error_content = E401_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E401_header);
                break;
            case 402:
                $_error_title = E402_title;
                $_error_content = E402_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E402_header);
                break;
            case 403:
                $_error_title = E403_title;
                $_error_content = E403_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E403_header);
                break;
            case 404:
                $_error_title = E404_title;
                $_error_content = E404_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E404_header);
                break;
            case 405:
                $_error_title = E405_title;
                $_error_content = E405_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E405_header);
                break;
                break;
            case 500:
                $_error_title = E500_title;
                $_error_content = E500_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E500_header);
                break;
            default:
                if($title == null || $content == null) {
                    $_error_title = "Erreur inconnu";
                    $_error_content = "Une erreur inconnu est survenu";
                }else{
                    $_error_title = $title;
                    $_error_content = $content;
                }
        }

        self::render([
            'status' => 'error',
            'code' => $error,
            'title' => $_error_title,
            'content' => $_error_content,
        ]);
    }

    private static function debug(){
        if(API_DEBUG){
            return [
                'php' => [
                    'version' => phpversion(),
                ],
                'sql' => [
                    'queries' => Wx_Query::getCount(),
                    'total_time' => Wx_Query::getTotalTime(),
                    'request' => Wx_Query::getTime(),
                ],
            ];
        }

        return null;
    }
}