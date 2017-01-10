<?php
    /**
     * Project: paneldev
     * License: GPL3.0
     * User: WinXaito
     */

    class OptionsManager{
        private $_db;

        /**
         * @param $db
         */
        public function __construct($db){
            $this->_db = $db;
        }

        /**
         * @param $userid
         * @return Options
         */
        public function get($userid){
            $q = $this->_db->prepare("
                SELECT *
                FROM options
                WHERE user = ?
            ");
            $q->execute(array(
                $userid
            ));
            $result = $q->fetch();

            $OptionsContent = new Options();
            $OptionsContent->setId($result['id']);
            $OptionsContent->setUser($userid);
            $OptionsContent->setOptProjects($result['opt_prokects']);
            $OptionsContent->setOptView($result['opt_view']);

            return $OptionsContent;
        }

        /**
         * @param Options $options
         */
        public function add(Options $options){
            $q = $this->_db->prepare("
                INSERT INTO options
                (user, opt_projects, opt_view)
                VALUES
                (:user, :opt_projects, :opt_view)
            ");
            $q->execute(array(
                'user' => $options->getUser(),
                'opt_projects' => $options->getOptProjects(),
                'opt_view' => $options->getOptView(),
            ));
        }

        /**
         * @param Options $options
         */
        public function update(Options $options){
            $q = $this->_db->prepare("
                UPDATE options
                SET opt_projects = :opt_projects,
                    opt_view = :opt_view
            ");
            $q->execute(array(
                'opt_projects' => $options->getOptProjects(),
                'opt_view' => $options->getOptView(),
            ));
        }
    }