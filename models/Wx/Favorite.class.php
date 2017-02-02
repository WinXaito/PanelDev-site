<?php

/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 16.01.2017
 */
class Wx_Favorite{
    private $_id;
    private $_project_id;
    private $_user_id;
    private $_date_created;

    /**
     * Wx_Favorite constructor.
     * @param $_id
     * @param $_project_id
     * @param $_user_id
     * @param $_date_created
     */
    public function __construct($_id, $_project_id, $_user_id, $_date_created){
        $this->_id = $_id;
        $this->_project_id = $_project_id;
        $this->_user_id = $_user_id;
        $this->_date_created = $_date_created;
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
    public function getProjectId(){
        return $this->_project_id;
    }

    /**
     * @param mixed $project_id
     */
    public function setProjectId($project_id){
        $this->_project_id = $project_id;
    }

    /**
     * @return mixed
     */
    public function getUserId(){
        return $this->_user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id){
        $this->_user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getDateCreated(){
        return $this->_date_created;
    }

    /**
     * @param mixed $date_created
     */
    public function setDateCreated($date_created){
        $this->_date_created = $date_created;
    }
}