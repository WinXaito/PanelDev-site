<?php
/**
 * Project: paneldev
 * License: GPL3.0
 * User: WinXaito
 */

class Wx_Project{
    private $_id;
    private $_name;
    private $_owner;
    private $_users;
    private $_type;
    private $_description;
    private $_url;
    private $_date_creation;
    private $_date_modification;
    private $_public;

    const TYPE = [
        'general',
        'website',
        'general-idea',
        'game',
        'print3d',
    ];

    /**
     * @param $name
     * @param $owner
     * @param $users
     * @param $type
     * @param $description
     * @param $url
     * @param $date_creation
     * @param $date_modification
     * @param $public
     * @param int $id
     */
    public function __construct($name, $owner, $users, $type, $description, $url, $date_creation, $date_modification, $public, $id=0){
        $this->_name = $name;
        $this->_owner = $owner;
        $this->_users = $users;
        $this->_type = $type;
        $this->_description = $description;
        $this->_url = $url;
        $this->_date_creation = $date_creation;
        $this->_date_modification = $date_modification;
        $this->_public = $public;
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
     * @return Wx_Project_PUsers
     */
    public function getUsers(){
        return $this->_users;
    }

    /**
     * @return mixed
     */
    public function getType(){
        $t = $this->_type;

        if(!in_array($t, Wx_Project::TYPE))
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
     * @return boolean
     */
    public function isPublic(){
        return $this->_public;
    }

    /**
     * @param mixed $public
     */
    public function setPublic($public){
        $this->_public = $public;
    }

    /**
     * @return string
     */
    public function showUsersTable(){
        //TODO: new tabe with .join (jointure)
        /*$users = $this->getUsers(true);

        if(empty($users)){
            return '';
        }else{
            $return = '';

            foreach($users as $key => $value){
                $return .= '<tr><td>'.$value.'</td><td><a href="">Supprimer</a></td></tr>';
            }

            return $return;
        }*/
    }
}