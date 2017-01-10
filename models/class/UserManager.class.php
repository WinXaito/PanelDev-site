<?php
    /**
     * Project: paneldev
     * License: GPL3.0
     * User: WinXaito
     */


    class UserManager{
        private $_db;
        private $_errors;
        private $_historicManager;

        /**
         * @param $db
         */
        public function __construct($db){
            $this->_db = $db;
        }

        /**
         * @param $historicManager
         */
        public function setHistoricManager($historicManager){
            $this->_historicManager = $historicManager;
        }

        /**
         * @return mixed
         */
        public function getErrors(){
            return $this->_errors;
        }

        /**
         * @param User $user
         * @return bool
         */
        public function add(User $user){
            $this->checkUsername($user);
            $this->checkEmail($user);
            $this->checkPassword($user);

            if($this->getErrors() == ""){
                $q = $this->_db->prepare("
                    INSERT INTO users
                    (name, password, email, grade)
                    VALUES
                    (:name, :password, :email, :grade)
                ");
                $q->execute(array(
                    'name' => $user->getName(),
                    'password' => sha1($user->getPassword()),
                    'email' => $user->getEmail(),
                    'grade' => $user->getGrade(),
                ));

                return true;
            }else{
                return false;
            }
        }

        /**
         * @param User $user
         * @return bool
         */
        public function update(User $user){
            $this->checkPassword($user);
            $this->checkEmail($user);

            if($this->getErrors() == ""){
                $user->setPassword($user->getPassword(), false);

                $q = $this->_db->prepare("
                    UPDATE users
                    SET name = :name,
                        password = :password,
                        email = :email,
                        grade = :grade,
                        firstname = :firstname,
                        lastname = :lastname
                    WHERE id = :id
                ");
                $q->execute(array(
                    'id' => $user->getId(),
                    'name' => $user->getName(),
                    'password' => $user->getPassword(),
                    'email' => $user->getEmail(),
                    'grade' => $user->getGrade(),
                    'firstname' => $user->getFirstName(),
                    'lastname' => $user->getLastName()
                ));

                return true;
            }else{
                return false;
            }
        }


        /**
         * @param $username
         * @return bool
         */
        public function getUserByName($username){
            $q = $this->_db->prepare("
                    SELECT *
                    FROM users
                    WHERE name = ?
                ");
            $q->execute(array(
                $username,
            ));
            $result = $q->fetch();

            if($result){
                $users = new User(
                    $result['name'],
                    $result['password'],
                    $result['email'],
                    $result['firstname'],
                    $result['lastname'],
                    $result['grade'],
                    $result['id']
                );
                return $users;
            }else{
                return false;
            }
        }

        /**
         * @param $userid
         * @return bool|User
         */
        public function getUserById($userid){
            $q = $this->_db->prepare("
                    SELECT *
                    FROM users
                    WHERE id = ?
                ");
            $q->execute(array(
                $userid,
            ));
            $result = $q->fetch();

            if($result){
                $users = new User(
                    $result['name'],
                    $result['password'],
                    $result['email'],
                    $result['firstname'],
                    $result['lastname'],
                    $result['grade'],
                    $result['id']
                );
                return $users;
            }else{
                return false;
            }
        }


        /**
         * @param User $user
         */
        private function checkUsername(User $user){
            $existUser = $this->getUserByName($user->getName());

            if($existUser)
                $this->addError('<p class="bg-primary message">L\'identifiant demandé existe déjà</p>');
            if(strlen($user->getName()) < 4 || strlen($user->getName()) > 15)
                $this->addError('<p class="bg-primary message">L\'identifiant doit se trouver entre 4 et 15 caractères</p>');
        }

        /**
         * @param User $user
         */
        private function checkPassword(User $user){
            if(strlen($user->getPassword()) < 6 || $user->getPassword() != $user->getPasswordConfirm())
                $this->addError('<p class="bg-primary message">Le mot de passe doit faire au moins 6 caractères et doit correspondre à sa confirmation</p>');
        }

        /**
         * @param User $user
         */
        private function checkEmail(User $user){
            if(!filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL))
                $this->addError('<p class="bg-primary message">L\'adresse email indiqué n\'est pas correcte</p>');
        }

        /**
         * @param $add
         */
        private function addError($add){
            $this->_errors = $this->_errors.$add;
        }
    }