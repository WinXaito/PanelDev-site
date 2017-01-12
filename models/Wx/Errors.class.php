<?php
    /**
     * Project: paneldev
     * License: GPL3.0
     * User: WinXaito
     */

    class Wx_Errors{
        private $_error;

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
            $_GET['error'] = $this->_error;
            require_once PATH.'/views/errors/errors.php';
            exit();
        }
    }