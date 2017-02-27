<?php
/**
 * Project: paneldev
 * License: GPL3.0
 * User: WinXaito
 */

require_once __DIR__.'/../../controllers/errors/errors_headers.php';

class Wx_Errors{
    private $_twig;
    private static $_error;

    private static $_error_title;
    private static $_error_content;

    public function __construct(Twig_Environment $twig){
        $this->_twig = $twig;
    }

    /**
     * @param $error
     */
    public function setAndShowError($error){
        $this->setError($error);
        $this->showError();
    }

    /**
     * @param $error
     */
    public static function setError($error){
        Wx_Errors::$_error = $error;
        Wx_Errors::textErrors();
    }

    /**
     * void
     */
    public function showError(){
        $this->render();
        exit();
    }

    public static function setAndShowErrorAjax($error){
        Wx_Errors::setError($error);
        Wx_Ajax::render([
            'status' => 'error',
            'code' => Wx_Errors::$_error,
            'title' => Wx_Errors::$_error_title,
            'content' => Wx_Errors::$_error_content,
        ]);
    }

    private static function textErrors(){
        switch(Wx_Errors::$_error){
            case 400:
                Wx_Errors::$_error_title = E400_title;
                Wx_Errors::$_error_content = E400_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E400_header);
                break;
            case 401:
                Wx_Errors::$_error_title = E401_title;
                Wx_Errors::$_error_content = E401_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E401_header);
                break;
            case 402:
                Wx_Errors::$_error_title = E402_title;
                Wx_Errors::$_error_content = E402_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E402_header);
                break;
            case 403:
                Wx_Errors::$_error_title = E403_title;
                Wx_Errors::$_error_content = E403_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E403_header);
                break;
            case 404:
                Wx_Errors::$_error_title = E404_title;
                Wx_Errors::$_error_content = E404_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E404_header);
                break;
            case 500:
                Wx_Errors::$_error_title = E500_title;
                Wx_Errors::$_error_content = E500_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E500_header);
                break;
            default:
                Wx_Errors::$_error_title = "Erreur inconnu";
                Wx_Errors::$_error_content = "Une erreur inconnu est survenu";
        }
    }

    private function render(){
        $breadcrum = new Wx_Breadcrum(
            false,
            [
                'Accueil' => '',
                'Erreur' => ''
            ]
        );

        echo $this->_twig->render('templates_pages/error/error.twig', [
            'breadcrum' => $breadcrum->getBreadcrum(),
            'title' => Wx_Errors::$_error_title,
            'content' => Wx_Errors::$_error_content,
        ]);

        Wx_Utils::showDebugInfos();
    }
}