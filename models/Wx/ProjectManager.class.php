<?php
/**
 * Project: paneldev
 * License: GPL3.0
 * User: WinXaito
 */

class Wx_ProjectManager{
    private $_db;
    private $_historicManager;
    private $_user;
    private $_errors = "";

    /**
     * @param Wx_HistoricManager $historicManager
     * @param Wx_User $user
     * @internal param PDO $db
     */
    public function __construct(Wx_HistoricManager $historicManager, Wx_User $user){
        $this->_historicManager = $historicManager;
        $this->_user = $user;
    }

    /**
     * @return string
     */
    public function getErrors(){
        return $this->_errors;
    }

    /**
     * @param $url
     * @return Wx_Project
     */
    public function get($url){
        $q = Wx_Query::query("
                SELECT *
                FROM projects
                WHERE url = ?
            " , [$url]
        );

        $resultProjects = $q->fetch();
        $q->closeCursor();

        if($resultProjects){
            $project = new Wx_Project(
                $resultProjects['name'],
                $resultProjects['owner'],
                $this->getProjectUsers($resultProjects['id']),
                $resultProjects['type'],
                $resultProjects['description'],
                $resultProjects['url'],
                $resultProjects['project_url'],
                $resultProjects['date_creation'],
                $resultProjects['date_modification'],
                $resultProjects['id']
            );

            return $project;
        }

        return null;
    }

    /**
     * @param Wx_Project $project
     * @return bool
     */
    public function add(Wx_Project $project){
        $success = true;

        $q = Wx_Query::query(
            "
                INSERT INTO projects
                (name, owner, users, type, description, url, project_url, date_creation, date_modification)
                VALUES
                (:name, :owner, :users, :type, :description, :url, :project_url, :date_creation, :date_modification)
            ",
            [
                'name' => $project->getName(),
                'owner' => $project->getOwner(),
                'users' => $project->getUsers(),
                'type' => $project->getType(),
                'description' => $project->getDescription(),
                'url' => $project->getUrl(),
                'project_url' => $project->getUrlProject(),
                'date_creation' => $project->getDateCreation(),
                'date_modification' => $project->getDateModification(),
            ]
        );

        if($q->errorCode() != "00000") {
            $historic_content = "Erreur lors de l'insertion en base de donnée";
            $success = false;
        }else {
            $historic_content = $project->getName() . ' (' . $project->getUrl() . ')';
        }

        $historic = new Wx_Historic($this->_user, Wx_Historic::TYPE_PROJECT, "Création d'un projet",
            $historic_content, time(), $_SERVER['REMOTE_ADDR']);

        $this->_historicManager->add($historic);

        return $success;
    }

    public function addAppPrint3d(Wx_Apps_Print3d $app){
        $success = true;

        $q = Wx_Query::query(
            "
                INSERT INTO app_print3d
                (project_id, printer_id, result_id, timelapse_id, stl_id, gcode_id, infos)
                VALUES
                (:project_id, :printer_id, :result_id, :timelapse_id, :stl_id, :gcode_id, :infos)
            ",
            [
                'project_id' => $app->getProjectId(),
                'printer_id' => $app->getPrinterId(),
                'result_id' => $app->getResultId(),
                'timelapse_id' => $app->getTimelapseId(),
                'stl_id' => $app->getStlId(),
                'gcode_id' => $app->getGcodeId(),
                'infos' => $app->getInfos(),
            ]
        );

        if($q->errorCode() != "00000") {
            $historic_content = "Erreur lors de l'insertion en base de données";
            $success = false;
        }else {
            $historic_content = 'Ajout App:Impression_3D (Project_id: ' . $app->getProjectId() . ')';
        }

        $historic = new Wx_Historic($this->_user, Wx_Historic::TYPE_PROJECT, "Création d'un projet",
            $historic_content, time(), $_SERVER['REMOTE_ADDR']);

        $this->_historicManager->add($historic);

        return $success;
    }

    /**
     * @param Wx_Project $project
     * @param $url
     */
    public function update(Wx_Project $project, $url){
        $q = Wx_Query::query(
            "
                UPDATE projects
                SET name = :name,
                    owner = :owner,
                    description = :description,
                    url = :url,
                    project_url = :project_url,
                    date_creation = :date_creation,
                    date_modification = :date_modification
                WHERE url = :urlfind
            ",
            [
                'name' => $project->getName(),
                'owner' => $project->getOwner(),
                'description' => $project->getDescription(),
                'url' => $project->getUrl(),
                'project_url' => $project->getUrlProject(),
                'date_creation' => $project->getDateCreation(),
                'date_modification' => $project->getDateModification(),
                'urlfind' => $url,
            ]
        );

        if($q->errorCode() != "00000")
            $historic_content = "Erreur lors de l'insertion en base de donnée";
        else
            $historic_content = $project->getName().' ('.$project->getUrl().')';

        $historic = new Wx_Historic($this->_user, Wx_Historic::TYPE_PROJECT, "Modification d'un projet",
            $historic_content, time(), $_SERVER['REMOTE_ADDR']);
        $this->_historicManager->add($historic);
    }

    /**
     * @param $url
     */
    public function remove($url){
        Wx_Query::query(
            "
                DELETE FROM projects
                WHERE url = ?
            ",
            [
                $url,
            ]
        );

        $historic = new Wx_Historic($this->_user, Wx_Historic::TYPE_PROJECT, "Suppression d'un projet", "Name", time(), $_SERVER['REMOTE_ADDR']);
        $this->_historicManager->add($historic);
    }

    /**
     * @return string
     */
    public function newUrl(){
        function randomString()
        {
            $characters = "12334567890abcdefghijklmnopqrstuvwxyzABCDEFIJKLMNOPQRSTUVWXYZ";
            $charactersLength = strlen($characters);
            $randomString = "";

            for($i = 0; $i < URL_PROJECTS_LENGTH; $i ++){
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            return $randomString;
        }

        while(true){
            $newUrl = randomString();

            $q = Wx_Query::query(
                "
                    SELECT *
                    FROM projects
                    WHERE url = ?
              ",
                [
                    $newUrl,
                ]
            );

            $result = $q->fetch();

            if(!$result)
                return $newUrl;
        }
    }

    /**
     * @param Wx_Project $project
     * @param Wx_User $user
     * @param $access
     * @internal param $useraccess
     * @internal param $userid
     * @internal param $username
     * @return string
     */
    public function addUser(Wx_Project $project, Wx_User $user, $access){
        /*if($users){
            if(!isset($users[$userid])){
                $users[$userid] = $username;
            }else{
                $this->_errors = $this->_errors.'<p class="bg-primary message">L\'utilisateur que vous souhaitez ajouter ce trouve déjà dans la liste des utilisateur</p>';
            }
        }else{
            $users = [$userid => $username];
        }

        $project->setUsers($users, false);
        $this->update($project, $project->getUrl());

        $historic = new Wx_Historic($this->_user, Wx_Historic::TYPE_PROJECT, "Ajout d'un utilisateur", "Name + URL + Username", time(), $_SERVER['REMOTE_ADDR']);
        $this->_historicManager->add($historic);*/

        if(!$project->getUsers()->existUser($user->getId())){
            Wx_Query::query(
                "
                    INSERT INTO projects_users
                    (project_id, user_id, access, date_added)
                    VALUES(:p_id, :u_id, :access, :date_added)
                ",
                [
                    'p_id' => $project->getId(),
                    'u_id' => $user->getId(),
                    'access' => $access,
                    'date_added' => time(),
                ]
            );

            return 'Utilisateur ajouté';
        }else{
            return 'L\'utilisateur se trouve déjà dans la liste';
        }
    }

    /**
     * @param Wx_Project $project
     * @param $username
     */
    public function removeUser(Wx_Project $project, $username){
        $users = $project->getUsers();
        if(isset($users[$username])){
            unset($users[$username]);
            $project->setUsers($users, false);
            $this->update($project, $project->getUrl());

            $historic = new Wx_Historic($this->_user, Wx_Historic::TYPE_PROJECT, "Suppression d'un utilisateur", "Name + URL + Username", time(), $_SERVER['REMOTE_ADDR']);
            $this->_historicManager->add($historic);
        }
    }


    /**
     * @param $url
     * @return string
     */
    public function testGet($url){
        $project = $this->get($url);

        return '
                <p>getUrl() '.$project->getUrl().'</p>
                <p>getOwner() '.$project->getOwner().'</p>
                <p>getDateCreation() '.$project->getDateCreation().'</p>
                <p>getDateModification() '.$project->getDateModification().'</p>
                <p>getId() '.$project->getId().'</p>
                <p>getUsers() '.$project->getUsers().'</p>
                <p>getName() '.$project->getName().'</p>
                <p>getUrlProject() '.$project->getUrlProject().'</p>
            ';
    }

    /**
     * @param Wx_User $_User
     * @return bool
     */
    public function hasProjects(Wx_User $_User){
        return !empty($this->getOwnerProjects($_User));
    }

    /**
     * @param Wx_User $_User
     * @param bool|false $little
     * @return string
     */
    public function showAllProjectsTable(Wx_User $_User, $little=false){
        $allProjects = $this->getOwnerProjects($_User);

        if(!$little){
            $th = '
                <th>ID</th>
                <th>Nom</th>
                <th>Date de création</th>
                <th>Date de modification</th>
                <th></th>
            ';
        }else{
            $th = '
                <th>Nom</th>
                <th>Date de création</th>
            ';
        }

        $tr = "";
        foreach($allProjects as $key => $value){
            if($value['owner'] == $_User->getId()){
                if($little){
                    $tr .= '
                        <tr>
                            <td><a href="'.URL_PATH.'/project/'.$value['url'].'/view">'.$value['name'].'</a></td>
                            <td>'.date("d/m/Y", $value['date_creation']).'</td>
                        </tr>
                    ';
                }else{
                    $date_modification = $value['date_modification'] == 0 ? "-" : date("d/m/Y", $value['date_modification']);

                    $tr .= '
                        <tr>
                            <td>#'.$value['id'].'</td>
                            <td><a href="'.URL_PATH.'/project/'.$value['url'].'/view">'.$value['name'].'</a></td>
                            <td>'.date("d/m/Y", $value['date_creation']).'</td>
                            <td>'.$date_modification.'</td>
                            <td><a href="'.URL_PATH.'/project/'.$value['url'].'/remove">Supprimer</a></td>
                        </tr>
                    ';
                }
            }
        }

        $return = "
            <table class=\"table table-striped\">
                <tr>
                    ".$th."
                </tr>
                ".$tr."
            </table>
        ";

        return $return;
    }

    public function getUserProjects(Wx_User $user){
        $q = Wx_Query::query(
            "
                SELECT *
                FROM projects_users pu
                JOIN projects p
                ON pu.project_id = p.id
                WHERE pu.user_id = ?
                AND p.owner != pu.user_id
            ",
            [
                $user->getId(),
            ]
        );

        $i = 0;
        $return = [];

        while($result = $q->fetch()){
            $return[$i] = $result;
            $i++;
        }

        return $return;
    }

    public function getProjectUsers($project_id){
        $q = Wx_Query::query(
            "
                SELECT pu.*, u.name
                FROM projects_users pu JOIN users u
                 ON u.id = pu.user_id
                WHERE pu.project_id = ?
            ",
            [
                $project_id,
            ]
        );

        $users = new Wx_Project_PUsers();
        while($data = $q->fetch()){
            $users->addUser($data['id'], $data['user_id'], $data['access'], $data['date_added'], $data['name']);
        }

        return $users;
    }

    /**
     * @param Wx_User $_User
     * @return array
     */
    public function getOwnerProjects(Wx_User $_User){
        $q = Wx_Query::query(
            "
                SELECT *
                FROM projects
                WHERE owner = :owner
            ",
            [
                'owner' => $_User->getId(),
            ]
        );

        $i=0;
        $return = [];

        while($result = $q->fetch()){
            $return[$i] = $result;
            $i++;
        }

        return $return;
    }

    public function getAllProjects(Wx_User $user){
        $projects = $this->getOwnerProjects($user);
        $projectsUser = $this->getUserProjects($user);
        return array_merge($projects, $projectsUser);
    }

    /**
     * @return array
     */
    /*public function getAllProjects(){
        $q = $this->_db->prepare("
            SELECT *
            FROM projects
        ");
        $q->execute();

        $i=0;
        $return = [];

        while($result = $q->fetch()){
            $return[$i] = $result;
            $i++;
        }

        return $return;
    }*/
}