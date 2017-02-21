<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 02.02.2017
 */
class Wx_Std_File{
    private $_id;
    private $_uniqId;
    private $_name;
    private $_description;
    private $_parent;
    private $_type;
    private $_url;
    private $_date_creation;
    private $_date_modification;

    /**
     * Wx_Std_File constructor.
     * @param $_id
     * @param $_uniqId
     * @param $_name
     * @param $_description
     * @param $_parent
     * @param $_type
     * @param $_url
     * @param $_date_creation
     * @param $_date_modification
     * @internal param $_parentType
     * @internal param $_parentId
     */
    public function __construct($_id, $_uniqId, $_name, $_description, $_parent, $_type, $_url, $_date_creation, $_date_modification){
        if($_uniqId == 0)
            $_uniqId = uniqid();

        $this->_id = $_id;
        $this->_uniqId = $_uniqId;
        $this->_name = $_name;
        $this->_description = $_description;
        $this->_parent = $_parent;
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
    public function getUniqId(){
        return $this->_uniqId;
    }

    /**
     * @param mixed $uniqId
     */
    public function setUniqId($uniqId){
        $this->_uniqId = $uniqId;
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
     * @return Wx_Apps_iApps mixed
     */
    public function getParent(){
        return $this->_parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent(Wx_Apps_iApps $parent){
        $this->_parent = $parent;
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