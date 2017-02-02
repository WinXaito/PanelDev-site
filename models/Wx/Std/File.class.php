<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 02.02.2017
 */
class Wx_Std_File{
    private $_id;
    private $_name;
    private $_description;
    private $_parentType;
    private $_parentId;
    private $_type;
    private $_url;
    private $_date_creation;
    private $_date_modification;

    /**
     * Wx_Std_File constructor.
     * @param $_id
     * @param $_name
     * @param $_description
     * @param $_parentType
     * @param $_parentId
     * @param $_type
     * @param $_url
     * @param $_date_creation
     * @param $_date_modification
     */
    public function __construct($_id, $_name, $_description, $_parentType, $_parentId, $_type, $_url, $_date_creation, $_date_modification){
        $this->_id = $_id;
        $this->_name = $_name;
        $this->_description = $_description;
        $this->_parentType = $_parentType;
        $this->_parentId = $_parentId;
        $this->_type = $_type;
        $this->_url = $_url;
        $this->_date_creation = $_date_creation;
        $this->_date_modification = $_date_modification;
    }

    /**
     * @return mixed
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
     * @param mixed $name
     */
    public function setName($name){
        $this->_name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription(){
        return $this->_description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description){
        $this->_description = $description;
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
    public function getParentType(){
        return $this->_parentType;
    }

    /**
     * @param mixed $parentType
     */
    public function setParentType($parentType){
        $this->_parentType = $parentType;
    }

    /**
     * @return mixed
     */
    public function getParentId(){
        return $this->_parentId;
    }

    /**
     * @param mixed $parentId
     */
    public function setParentId($parentId){
        $this->_parentId = $parentId;
    }

    /**
     * @return mixed
     */
    public function getType(){
        return $this->_type;
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
    public function getUrl(){
        return $this->_url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url){
        $this->_url = $url;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->_date_creation;
    }

    /**
     * @param mixed $date_creation
     */
    public function setDateCreation($date_creation)
    {
        $this->_date_creation = $date_creation;
    }

    /**
     * @return mixed
     */
    public function getDateModification(){
        return $this->_date_modification;
    }

    /**
     * @param mixed $date_modification
     */
    public function setDateModification($date_modification){
        $this->_date_modification = $date_modification;
    }
}