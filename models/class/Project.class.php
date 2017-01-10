<?php
    /**
     * Project: paneldev
     * License: GPL3.0
     * User: WinXaito
     */

    class Project{
        private $_id;
        private $_name;
        private $_owner;
        private $_users;
        private $_type;
        private $_description;
        private $_url;
        private $_urlProject;
        private $_date_creation;
        private $_date_modification;

        /**
         * @param $name
         * @param $owner
         * @param $users
         * @param $description
         * @param $url
         * @param $urlProject
         * @param $date_creation
         * @param $date_modification
         * @param int $id
         */
        public function __construct($name, $owner, $users, $type, $description, $url, $urlProject, $date_creation, $date_modification, $id=0){
            $this->_name = $name;
            $this->_owner = $owner;
            $this->_users = $users;
            $this->_type = $type;
            $this->_description = $description;
            $this->_url = $url;
            $this->_urlProject = $urlProject;
            $this->_date_creation = $date_creation;
            $this->_date_modification = $date_modification;
            $this->_id = $id;
        }

        /**
         * @return int
         */
        public function getId(){
            return $this->_id;
        }

        /**
         * @return mixed
         */
        public function getName(){
            return $this->_name;
        }

        /**
         * @param $name
         */
        public function setName($name){
            $this->_name = $name;
        }

        /**
         * @return mixed
         */
        public function getOwner(){
            return $this->_owner;
        }

        /**
         * @param $owner
         */
        public function setOwner($owner){
            $this->_owner = $owner;
        }

        /**
         * @param bool|false $unserialize
         * @return mixed
         */
        public function getUsers($unserialize=false){
            return $unserialize ? unserialize($this->_users) : $this->_users;
        }

        /**
         * @param $users
         * @param bool|true $serialize
         */
        public function setUsers($users, $serialize=true){
            $this->_users = $serialize ? $users : serialize($users);
        }

        /**
         * @return mixed
         */
        public function getType(){
            $t = $this->_type;

            if($t != 'general' && $t != 'website' && $t != 'general-idea' && $t != 'game')
                $t = 'general';

            return $t;
        }

        /**
         * @param mixed $type
         */
        public function setType($type){
            $this->_type = $type;
        }


        /**
         * @return mixed
         */
        public function getDescription(){
            return $this->_description;
        }

        /**
         * @param $description
         */
        public function setDescription($description){
            $this->_description = $description;
        }

        /**
         * @return mixed
         */
        public function getUrl(){
            return $this->_url;
        }

        /**
         * @param $url
         */
        public function setUrl($url){
            $this->_url = $url;
        }

        /**
         * @return mixed
         */
        public function getUrlProject(){
            return $this->_urlProject;
        }

        /**
         * @param $urlProject
         */
        public function setUrlProject($urlProject){
            $this->_urlProject = $urlProject;
        }

        /**
         * @return mixed
         */
        public function getDateCreation(){
            return $this->_date_creation;
        }

        /**
         * @return mixed
         */
        public function getDateModification(){
            return $this->_date_modification;
        }

        /**
         * @param $date_modification
         */
        public function setDateModification($date_modification){
            $this->_date_modification = $date_modification;
        }

        /**
         * @return string
         */
        public function showUsersTable(){
            $users = $this->getUsers(true);

            if(empty($users)){
                return '';
            }else{
                $return = '';

                foreach($users as $key => $value){
                    $return .= '<tr><td>'.$value.'</td><td><a href="">Supprimer</a></td></tr>';
                }

                return $return;
            }
        }
    }