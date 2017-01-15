<?php

/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 14.01.2017
 */

class Wx_Project_PUsers{
    private $_users;

    public function addUser($id, $user_id, $access, $date_added, $name){
        $this->_users[$id] = new Wx_Project_PUser($id, $user_id, $access, $date_added, $name);
    }

    public function removeUser($id){
        unset($this->_users[$id]);
    }

    public function getUsers(){
        return $this->_users;
    }

    public function existUser($id){
        if(empty($this->_users))
            return false;

        foreach($this->_users as $u){
            if($u->getUserId() == $id)
                return true;
        }

        return false;
    }
}