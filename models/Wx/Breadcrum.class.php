<?php
    /**
     * Project: paneldev
     * License: GPL3.0
     * User: WinXaito
     */

    class Wx_Breadcrum{
        private $_breadcrum;
        private $_url;

        /**
         * @param $totalUrl
         * @param array $urlName
         */
        public function __construct($totalUrl, array $urlName){
            $this->start();
            $i = 1;
            $max_i = count($urlName);
            foreach($urlName as $key => $value){
                $last = $i == $max_i ? true : false;
                $totalUrl ? $this->addNameUrlTotal($key, $value, $last) : $this->addNameUrlShort($key, $value, $last);

                $i++;
            }
            $this->end();
        }

        /**
         * @param $name
         * @param $url
         * @param $last
         */
        public function addNameUrlTotal($name, $url, $last){
            $home_url = $url == "" ? URL_PATH_HOME : URL_PATH;

            if($last){
                $this->_breadcrum = $this->_breadcrum.'<span class="breadcrum-nolink">'.$name.'</span>';
            }else{
                $this->_breadcrum = $this->_breadcrum.'<span><a href="'.$home_url.$url.'">'.$name.'</a></span> › ';
            }
        }

        /**
         * @param $name
         * @param $partialUrl
         * @param $last
         */
        public function addNameUrlShort($name, $partialUrl, $last){
            if($partialUrl == "")
                $this->_url = URL_PATH_HOME;

            $this->_url = $this->_url.$partialUrl;

            if($last)
                $this->_breadcrum = $this->_breadcrum.'<span class="breadcrum-nolink">'.$name.'</span>';
            else
                $this->_breadcrum = $this->_breadcrum.'<span><a href="'.$this->_url.'">'.$name.'</a></span> › ';
        }

        /**
         * void
         */
        public function start(){
            $this->_breadcrum = '<p class="breadcrum">';
        }

        /**
         * void
         */
        public function end(){
            $this->_breadcrum = $this->_breadcrum.'</p>';
        }

        /**
         * @return string
         */
        public function show(){
            return $this->_breadcrum;
        }
    }