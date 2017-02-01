<?php
    /**
     * Project: paneldev
     * License: GPL3.0
     * User: WinXaito
     */

    class Wx_OptionsManager{
        private $_db;

        /**
         * @param $db
         */
        public function __construct($db){
            $this->_db = $db;
        }

        /**
         * @param $userid
         * @return Wx_Options
         */
        public function get($userid){
            $q = Wx_Query::query("
                SELECT *
                FROM options
                WHERE user = ?
                ", [$userid]
            );

            $result = $q->fetch();

            $OptionsContent = new Wx_Options();
            $OptionsContent->setId($result['id']);
            $OptionsContent->setUser($userid);
            $OptionsContent->setOptProjects($result['opt_prokects']);
            $OptionsContent->setOptView($result['opt_view']);

            return $OptionsContent;
        }

        /**
         * @param Wx_Options $options
         */
        public function add(Wx_Options $options){
            Wx_Query::query(
                "
                    INSERT INTO options
                    (user, opt_projects, opt_view)
                    VALUES
                    (:user, :opt_projects, :opt_view)
                ",
                [
                    'user' => $options->getUser(),
                    'opt_projects' => $options->getOptProjects(),
                    'opt_view' => $options->getOptView()
                ]
            );
        }

        /**
         * @param Wx_Options $options
         */
        public function update(Wx_Options $options){
            Wx_Query::query(
                "
                    UPDATE options
                    SET opt_projects = :opt_projects,
                      opt_view = :opt_view
                ",
                [
                    'opt_projects' => $options->getOptProjects(),
                    'opt_view' => $options->getOptView(),
                ]
            );
        }
    }