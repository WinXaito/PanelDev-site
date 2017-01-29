<?php

/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 16.01.2017
 */
class Wx_Favorites{
    private $_favorites;
    
    public function addFavorite($id, $project_id, $user_id, $date_creation){
        $this->_favorites[$id] = new Wx_Favorite($id, $project_id, $user_id, $date_creation);
    }

    public function removeUser($id){
        unset($this->_favorites[$id]);
    }

    public function getFavorites(){
        return $this->_favorites;
    }

    public function existProject($id){
        if(empty($this->_favorites))
            return false;

        foreach($this->_favorites as $f){
            /* @var $f Wx_Favorite */
            if($f->getProjectId() == $id)
                return true;
        }

        return false;
    }
}