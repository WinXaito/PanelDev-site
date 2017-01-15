<?php

/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 14.01.2017
 */
class Wx_Project_PUser{
    private $_id;
    private $_access;
    private $_date_added;
    private $_name;

    public function __construct($id, $user_id, $access, $date_added, $name){
        $this->_id = $id;
        $this->_access = $access;
        $this->_date_added = $date_added;
        $this->_name = $name;
    }

    /**
 * @return mixed
 */
    public function getId(){
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id){
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserId(){
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setUserId($id){
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getAccess(){
        return $this->_access;
    }

    /**
     * @param mixed $access
     */
    public function setAccess($access){
        $this->_access = $access;
    }

    /**
     * @return mixed
     */
    public function getDateAdded(){
        return $this->_date_added;
    }

    /**
     * @param mixed $date_added
     */
    public function setDateAdded($date_added){
        $this->_date_added = $date_added;
    }

    /**
     * @return mixed
     */
    public function getName(){
        return $this->_name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name){
        $this->_name = $name;
    }

    public function getLitteralAccess(){
        switch($this->_access){
            case 0:
                return "Administrateur";
                break;
            case 1:
                return "Administrateur second";
                break;
            case 2:
                return "Modérateur";
                break;
            case 3:
                return "Membre";
                break;
            default:
                return "";
        }
    }
}