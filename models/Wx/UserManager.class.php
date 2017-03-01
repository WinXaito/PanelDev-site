<?php
/**
 * Project: paneldev
 * License: GPL3.0
 * User: WinXaito
 */


class Wx_UserManager{
    private static $_errors;

    /**
     * @return mixed
     */
    public static function getErrors(){
        return self::$_errors;
    }

    /**
     * @param Wx_User $user
     * @return bool
     */
    public static function add(Wx_User $user){
        self::checkUsername($user);
        self::checkEmail($user);
        self::checkPassword($user);

        //TODO if utility ?
        //if($this->getErrors() == ""){
            Wx_Query::query(
                "
                    INSERT INTO users
                    (name, password, email, grade)
                    VALUES
                    (:name, :password, :email, :grade)
                ",
                [
                    'name' => $user->getName(),
                    'password' => sha1($user->getPassword()),
                    'email' => $user->getEmail(),
                    'grade' => $user->getGrade(),
                ]
            );

            var_dump($q->errorInfo());

            return true;
        //}else{
            //return false;
        //}
    }

    /**
     * @param Wx_User $user
     * @return bool
     */
    public static function update(Wx_User $user){
        self::checkPassword($user);
        self::checkEmail($user);

        if(self::getErrors() == ""){
            $user->setPassword($user->getPassword(), false);

            Wx_Query::query(
                "
                    UPDATE users
                    SET name = :name,
                        password = :password,
                        email = :email,
                        grade = :grade,
                        firstname = :firstname,
                        lastname = :lastname
                    WHERE id = :id
                ",
                [
                    'id' => $user->getId(),
                    'name' => $user->getName(),
                    'password' => $user->getPassword(),
                    'email' => $user->getEmail(),
                    'grade' => $user->getGrade(),
                    'firstname' => $user->getFirstName(),
                    'lastname' => $user->getLastName()
                ]
            );

            return true;
        }else{
            return false;
        }
    }


    /**
     * @param $username
     * @return bool|Wx_User
     */
    public static function getUserByName($username){
        $q = Wx_Query::query(
            "
                SELECT *
                FROM users
                WHERE name = ?
            ",
            [
                $username,
            ]
        );

        $result = $q->fetch();

        if($result){
            $users = new Wx_User(
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
     * @return bool|Wx_User
     */
    public static function getUserById($userid){
        $q = Wx_Query::query(
            "
                SELECT *
                FROM users
                WHERE id = ?
            ",
            [
                $userid,
            ]
        );

        $result = $q->fetch();

        if($result){
            $users = new Wx_User(
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

    public static function addFavorite(Wx_Project $project, Wx_User $user){
        //TODO Function -> Wx_User ?
        Wx_Query::query(
            "
                INSERT INTO projects_fav
                (project_id, user_id, date_Created)
                VALUES
                (:p_id, :u_id, d_added)
            ",
            [
                'p_id' => $project->getId(),
                'u_id' => $user->getId(),
                'd_added' => time(),
            ]
        );
    }

    public static function removeFavorite($id, Wx_User $user){
        //TODO: Function -> Wx_User ?
        Wx_Query::query(
            "
                DELETE FROM projects_fav
                WHERE id = :id AND user_id = :u_id
            ",
            [
                'id' => $id,
                'u_id' => $user->getId(),
            ]
        );

        if($q->rowCount() == 0)
            return false;
        else
            return true;
    }

    public static function getFavorite($id){
        //TODO: Function -> Wx_User ?
        $q = Wx_Query::query(
            "
                SELECT *
                FROM projects_fav
                WHERE id = ?
            ",
            [
                $id,
            ]
        );

        if($data = $q->fetch()){
            return new Wx_Favorite($data['id'], $data['project_id'], $data['user_id'], $data['date_created']);
        }else{
            return null;
        }
    }

    public static function getFavorites(Wx_User $user){
        //TODO: Function -> Wx_User ?
        Wx_Query::query(
            "
                SELECT *
                FROM projects_fav
                WHERE user_id = ?
            ",
            [
                $user->getId(),
            ]
        );

        $fav = new Wx_Favorites();
        while($data = $q->fetch()){
            $fav->addFavorite($data['id'], $data['project_id'], $data['user_id'], $data['date_created']);
        }

        return $fav;
    }


    /**
     * @param Wx_User $user
     */
    private static function checkUsername(Wx_User $user){
        $existUser = self::getUserByName($user->getName());

        if($existUser)
            self::addError('<p class="bg-primary message">L\'identifiant demandé existe déjà</p>');
        if(strlen($user->getName()) < 4 || strlen($user->getName()) > 15)
            self::addError('<p class="bg-primary message">L\'identifiant doit se trouver entre 4 et 15 caractères</p>');
    }

    /**
     * @param Wx_User $user
     */
    private static function checkPassword(Wx_User $user){
        if(strlen($user->getPassword()) < 6 || $user->getPassword() != $user->getPasswordConfirm())
            self::addError('<p class="bg-primary message">Le mot de passe doit faire au moins 6 caractères et doit correspondre à sa confirmation</p>');
    }

    /**
     * @param Wx_User $user
     */
    private static function checkEmail(Wx_User $user){
        if(!filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL))
            self::addError('<p class="bg-primary message">L\'adresse email indiqué n\'est pas correcte</p>');
    }

    /**
     * @param $add
     */
    private static function addError($add){
        self::$_errors = self::$_errors.$add;
    }
}