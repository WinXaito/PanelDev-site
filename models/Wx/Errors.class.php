<?php
/**
 * Project: paneldev
 * License: GPL3.0
 * User: WinXaito
 */

require_once __DIR__.'/../../controllers/errors/errors_headers.php';

class Wx_Errors{
    private $_twig;
    private $_error;

    private $_error_title;
    private $_error_content;

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
    public function setError($error){
        $this->_error = $error;
    }

    /**
     * void
     */
    public function showError(){
        $this->textErrors();
        $this->render();
        exit();
    }

    private function textErrors(){
        switch($this->_error){
            case 400:
                $this->_error_title = E400_title;
                $this->_error_content = E400_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E400_header);
                break;
            case 401:
                $this->_error_title = E401_title;
                $this->_error_content = E401_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E401_header);
                break;
            case 402:
                $this->_error_title = E402_title;
                $this->_error_content = E402_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E402_header);
                break;
            case 403:
                $this->_error_title = E403_title;
                $this->_error_content = E403_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E403_header);
                break;
            case 404:
                $this->_error_title = E404_title;
                $this->_error_content = E404_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E404_header);
                break;
            case 500:
                $this->_error_title = E500_title;
                $this->_error_content = E500_content;
                header($_SERVER['SERVER_PROTOCOL']." ".E500_header);
                break;
            default:
                $this->_error_title = "Erreur inconnu";
                $this->_error_content = "Une erreur inconnu est survenu";
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
            'title' => $this->_error_title,
            'content' => $this->_error_content,
        ]);

        Wx_Utils::showDebugInfos();
    }
}