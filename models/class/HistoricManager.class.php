<?php
    /**
     * Project: paneldev
     * License: GPL3.0
     * User: WinXaito
     */

    class HistoricManager{
        private $_db;
        private $_User;

        /**
         * @param $db
         * @param $_User
         */
        public function __construct(PDO $db, User $_User){
            $this->_db = $db;
            $this->_User = $_User;
        }

        /**
         * @return array
         */
        public function getAllHistoric(){
            $q = $this->_db->prepare("
                SELECT *
                FROM historic
                WHERE user = ?
                ORDER BY time DESC
            ");
            $q->execute(array(
                $this->_User->getId(),
            ));

            $i = 0;
            $return = [];
            while($result = $q->fetch()){
                $return[$i] = new Historic($this->_User, $result['type'], $result['title'],$result['content'], $result['time'], $result['ip'], $result['id']);
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
         * @param Historic $historic
         * @return void
         */
        public function add(Historic $historic){
            $q = $this->_db->prepare("
                INSERT INTO historic
                (user, type, title, content, time, ip)
                VALUES
                (:user, :type, :title, :content, :time, :ip)
            ");
            $q->execute(array(
                'user' => $this->_User->getId(),
                'type' => $historic->getType(),
                'title' => $historic->getTitle(),
                'content' => $historic->getContent(),
                'time' => $historic->getTime(),
                'ip' => $historic->getIp()
            ));
        }

        /**
         * @param void
         * @return void
         */
        public function removeAllHistoric(){
            $q = $this->_db->prepare("
                DELETE FROM historic
                WHERE user = :user
            ");
            $q->execute(array(
                 $this->_User->getId(),
            ));
        }
    }