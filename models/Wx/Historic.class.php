<?php
/**
 * Project: paneldev
 * License: GPL3.0
 * User: WinXaito
 */

class Wx_Historic{
    private $_User;
    private $_id;
    private $_type;
    private $_title;
    private $_content;
    private $_time;
    private $_ip;

    const TYPE_OTHER = 0;
    const TYPE_AUTH = 1;
    const TYPE_PROJECT = 2;
    const TYPE_ADMIN = 3;


    /**
     * @param Wx_User $_User
     * @param $type
     * @param $title
     * @param $content
     * @param $time
     * @param $ip
     * @param int $id
     */
    public function __construct(Wx_User $_User, $type, $title, $content, $time, $ip, $id=0){
        $this->_User = $_User;
        $this->setType($type);
        $this->setTitle($title);
        $this->setContent($content);
        $this->setTime($time);
        $this->setIp($ip);
        $this->_id = $id;
    }

    /**
     * @param Wx_User $user
     */
    public function setUser(Wx_User $user){
        $this->_User = $user;
    }

    /**
     * @return int
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
    public function getType(){
        return $this->_type;
    }

    /**
     * @return string
     */
    public function getTypeReadable(){
        switch($this->getType()){
            case self::TYPE_AUTH:
                return 'Authentification';
            case self::TYPE_PROJECT:
                return 'Projets';
            case self::TYPE_ADMIN:
                return 'Administration';
            default:
                return 'Autre';
        }
    }

    /**
     * @param $type
     */
    public function setType($type){
        $this->_type = $type;
    }

    /**
     * @return mixed
     */
    public function getTitle(){
        return $this->_title;
    }

    /**
     * @param $title
     */
    public function setTitle($title){
        $this->_title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent(){
        return $this->_content;
    }

    /**
     * @param $content
     */
    public function setContent($content){
        $this->_content = $content;
    }

    /**
     * @return mixed
     */
    public function getTime(){
        return $this->_time;
    }

    /**
     * @return bool|string
     */
    public function getTimeReadable(){
        return date("d/m/Y H:i", $this->_time);
    }

    /**
     * @param $time
     */
    public function setTime($time){
        $this->_time = $time;
    }

    /**
     * @return mixed
     */
    public function getIp(){
        return $this->_ip;
    }

    /**
     * @param $ip
     */
    public function setIp($ip){
        $this->_ip = $ip;
    }
}