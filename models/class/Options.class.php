<?php
    /**
     * Project: paneldev
     * License: GPL3.0
     * User: WinXaito
     */

    class Options{
        private $_user;
        private $_id;
        private $_opt_projects;
        private $_opt_view;

        /**
         * @return mixed
         */
        public function getId(){
            return $this->_id;
        }

        /**
         * @param $id
         */
        public function setId($id){
            $this->_id = $id;
        }

        /**
         * @return mixed
         */
        public function getUser(){
            return $this->_user;
        }

        /**
         * @param $user
         */
        public function setUser($user){
            $this->_user = $user;
        }

        /**
         * @return mixed
         */
        public function getOptProjects(){
            return $this->_opt_projects;
        }

        /**
         * @param $optProjects
         */
        public function setOptProjects($optProjects){
            $this->_opt_projects = $optProjects;
        }

        /**
         * @return mixed
         */
        public function getOptView(){
            return $this->_opt_view;
        }

        /**
         * @param $optView
         */
        public function setOptView($optView){
            $this->_opt_view = $optView;
        }
    }