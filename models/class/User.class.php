<?php
    /**
     * Project: paneldev
     * License: GPL3.0
     * User: WinXaito
     */

    class User{
        private $_id;
        private $_name;
        private $_password;
        private $_passwordConfirm;
        private $_email;
        private $_firstname;
        private $_lastname;
        private $_grade;

        const GRADE_INITIAL = 1;
        const GRADE_MODERATOR = 3;
        const GRADE_ADMINISTRATOR = 4;

        /**
         * @param $name
         * @param $password
         * @param $email
         * @param $firstname
         * @param $lastname
         * @param $grade
         * @param int $id
         */
        public function __construct($name, $password, $email, $firstname, $lastname, $grade, $id=0){
            $this->_name = $name;
            $this->_password = $password;
            $this->_email = $email;
            $this->_firstname = $firstname;
            $this->_lastname = $lastname;
            $this->_grade = $grade;
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
        public function getPassword(){
            return $this->_password;
        }

        /**
         * @param $password
         * @param bool|true $sha
         */
        public function setPassword($password, $sha=true){
            $this->_password = $sha ? $password : sha1($password);
        }

        /**
         * @return mixed
         */
        public function getPasswordConfirm(){
            return $this->_passwordConfirm;
        }

        /**
         * @param $passwordConfirm
         */
        public function setPasswordConfirm($passwordConfirm){
            $this->_passwordConfirm = $passwordConfirm;
        }

        /**
         * @return mixed
         */
        public function getEmail(){
            return $this->_email;
        }

        /**
         * @param $email
         */
        public function setEmail($email){
            $this->_email = $email;
        }

        /**
         * @return mixed
         */
        public function getFirstName(){
            return $this->_firstname;
        }

        /**
         * @param $firstname
         */
        public function setFirstName($firstname){
            $this->_firstname = $firstname;
        }

        /**
         * @return mixed
         */
        public function getLastName(){
            return $this->_lastname;
        }

        /**
         * @param $lastname
         */
        public function setLastName($lastname){
            $this->_lastname = $lastname;
        }

        /**
         * @return mixed
         */
        public function getGrade(){
            return $this->_grade;
        }

        /**
         * @param $grade
         */
        public function setGrade($grade){
            $this->_grade = $grade;
        }

        /**
         * @return array
         */
        public function getSession(){
            return [
                'id' => $this->getId(),
                'name' => $this->getName(),
                'password' => $this->getPassword(),
                'email' => $this->getEmail(),
                'firstname' => $this->getFirstName(),
                'lastname' => $this->getLastName(),
                'grade' => $this->getGrade(),
            ];
        }

        /**
         * @return bool
         */
        public function isModerator(){
            return $this->getGrade() == self::GRADE_MODERATOR ? true : false;
        }

        /**
         * @return bool
         */
        public function isAdministrator(){
            return $this->getGrade() == self::GRADE_ADMINISTRATOR ? true : false;
        }

        /**
         * @param User $user
         */
        public function deconnect(User $user){
            unset($user);
            session_destroy();
        }
    }