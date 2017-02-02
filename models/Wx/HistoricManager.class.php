<?php
/**
 * Project: paneldev
 * License: GPL3.0
 * User: WinXaito
 */

class Wx_HistoricManager{
    private $_User;

    /**
     * @param $_User
     */
    public function __construct(Wx_User $_User){
        $this->_User = $_User;
    }

    /**
     * @return array
     */
    public function getAllHistoric(){
        $q = Wx_Query::query(
            "
                SELECT *
                FROM historic
                WHERE user = ?
                ORDER BY time DESC
            ",
            [
                $this->_User->getId(),
            ]
        );

        $i = 0;
        $return = [];
        while($result = $q->fetch()){
            $return[$i] = new Wx_Historic($this->_User, $result['type'], $result['title'],$result['content'], $result['time'], $result['ip'], $result['id']);
            $i++;
        }
        return $return;
    }

    /**
     * @return string
     */
    public function showAllHistoricTable(){
        $historic = $this->getAllHistoric();

        $td = "";
        foreach($historic as $key => $value){
            $td .= '
                <tr>
                    <td>'.$value->getTimeReadable().'</td>
                    <td>'.$value->getTypeReadable().'</td>
                    <td>'.$value->getTitle().'</td>
                    <td>'.$value->getContent().'</td>
                    <td>'.$value->getIp().'</td>
                </tr>
            ';
        }

        $return = '
            <table class="table table-striped">
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Titre</th>
                    <th>Détail</th>
                    <th>Adresse IP</th>
                </tr>
                '.$td.'
            </table>
        ';

        return $return;
    }

    /**
     * @param Wx_Historic $historic
     * @return void
     */
    public function add(Wx_Historic $historic){
        Wx_Query::query(
            "
                INSERT INTO historic
                (user, type, title, content, time, ip)
                VALUES
                (:user, :type, :title, :content, :time, :ip)
            ",
            [
                'user' => $this->_User->getId(),
                'type' => $historic->getType(),
                'title' => $historic->getTitle(),
                'content' => $historic->getContent(),
                'time' => $historic->getTime(),
                'ip' => $historic->getIp()
            ]
        );
    }

    /**
     * @param void
     * @return void
     */
    public function removeAllHistoric(){
        Wx_Query::query(
            "
                DELETE FROM historic
              WHERE user = :user
            ",
            [
                $this->_User->getId(),
            ]
        );
    }
}