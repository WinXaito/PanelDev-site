<?php
/**
 * Project: paneldev
 * License: GPL3.0
 * User: WinXaito
 */

class Wx_ProjectManager{
    private static $_errors = "";

    /**
     * @return string
     */
    public static function getErrors(){
        return self::$_errors;
    }

    /**
     * @param $url
     * @return null|Wx_Project
     */
    public static function get($url){
        $q = Wx_Query::query("
                SELECT *
                FROM projects
                WHERE url = :url
            " , ['url' => $url]
        );

        $resultProjects = $q->fetch();
        $q->closeCursor();

        if($resultProjects){
            $project = new Wx_Project(
                $resultProjects['app_id'],
                $resultProjects['name'],
                $resultProjects['owner'],
                $resultProjects['type'],
                $resultProjects['description'],
                $resultProjects['url'],
                $resultProjects['date_creation'],
                $resultProjects['date_modification'],
                $resultProjects['public'],
                $resultProjects['id']
            );

            return $project;
        }

        return null;
    }

    /**
     * @param $project_id
     * @return null|Wx_Project
     */
    public static function getId($project_id){
        $q = Wx_Query::query("
                SELECT *
                FROM projects
                WHERE id = :id
            " , ['id' => $project_id]
        );

        $resultProjects = $q->fetch();
        $q->closeCursor();

        if($resultProjects){
            $project = new Wx_Project(
                $resultProjects['app_id'],
                $resultProjects['name'],
                $resultProjects['owner'],
                $resultProjects['type'],
                $resultProjects['description'],
                $resultProjects['url'],
                $resultProjects['date_creation'],
                $resultProjects['date_modification'],
                $resultProjects['public'],
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
    public static function add(Wx_Project $project){
        $success = true;

        $q = Wx_Query::query(
            "
                INSERT INTO projects
                (app_id, name, owner, type, description, url, date_creation, date_modification, public)
                VALUES
                (:app_id, :name, :owner, :type, :description, :url, :date_creation, :date_modification, :public)
            ",
            [
                'app_id' => 0,
                'name' => $project->getName(),
                'owner' => $project->getOwner(),
                'type' => $project->getType(),
                'description' => $project->getDescription(),
                'url' => $project->getUrl(),
                'date_creation' => $project->getDateCreation(),
                'date_modification' => $project->getDateModification(),
                'public' => $project->isPublic(),
            ]
        );

        if($q->errorCode() != "00000") {
            $historic_content = "Erreur lors de l'insertion en base de donnée";
            $success = false;
        }else {
            $historic_content = $project->getName() . ' (' . $project->getUrl() . ')';
        }

        $historic = new Wx_Historic(Wx_Session::getUser(), Wx_Historic::TYPE_PROJECT, "Création d'un projet",
            $historic_content, time(), $_SERVER['REMOTE_ADDR']);

        Wx_HistoricManager::add($historic);

        return $success;
    }

    /**
     * @param Wx_Apps_Print3d $app
     * @return bool
     */
    public static function addAppPrint3d(Wx_Apps_Print3d $app){
        //TODO: Move to Wx_Print3dManager
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

        $historic = new Wx_Historic(Wx_Session::getUser(), Wx_Historic::TYPE_PROJECT, "Création d'un projet",
            $historic_content, time(), $_SERVER['REMOTE_ADDR']);

        Wx_HistoricManager::add($historic);

        return $success;
    }

    /**
     * @param Wx_Project $project
     * @param $url
     */
    public static function update(Wx_Project $project, $url){
        $q = Wx_Query::query(
            "
                UPDATE projects
                SET name = :name,
                    owner = :owner,
                    description = :description,
                    url = :url,
                    date_creation = :date_creation,
                    date_modification = :date_modification,
                    public = :public
                WHERE url = :urlfind
            ",
            [
                'name' => $project->getName(),
                'owner' => $project->getOwner(),
                'description' => $project->getDescription(),
                'url' => $project->getUrl(),
                'date_creation' => $project->getDateCreation(),
                'date_modification' => $project->getDateModification(),
                'public' => $project->isPublic(),
                'urlfind' => $url,
            ]
        );

        if($q->errorCode() != "00000")
            $historic_content = "Erreur lors de l'insertion en base de donnée";
        else
            $historic_content = $project->getName().' ('.$project->getUrl().')';

        $historic = new Wx_Historic(Wx_Session::getUser(), Wx_Historic::TYPE_PROJECT, "Modification d'un projet",
            $historic_content, time(), $_SERVER['REMOTE_ADDR']);

        Wx_HistoricManager::add($historic);
    }

    /**
     * @param $url
     */
    public static function remove($url){
        Wx_Query::query(
            "
                DELETE FROM projects
                WHERE url = :url
            ",
            [
                'url' => $url,
            ]
        );

        $historic = new Wx_Historic(Wx_Session::getUser(), Wx_Historic::TYPE_PROJECT, "Suppression d'un projet", "Name", time(), $_SERVER['REMOTE_ADDR']);
        Wx_HistoricManager::add($historic);
    }

    /**
     * @return string
     */
    public static function newUrl(){
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
                    WHERE url = :url
              ",
                [
                    'url' => $newUrl,
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
    public static function addUser(Wx_Project $project, Wx_User $user, $access){
        //TODO: Clean method
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
    public static function removeUser(Wx_Project $project, $username){
        $users = $project->getUsers();
        if(isset($users[$username])){
            unset($users[$username]);
            $project->setUsers($users, false);
            self::update($project, $project->getUrl());

            $historic = new Wx_Historic(Wx_Session::getUser(), Wx_Historic::TYPE_PROJECT, "Suppression d'un utilisateur", "Name + URL + Username", time(), $_SERVER['REMOTE_ADDR']);
            Wx_HistoricManager::add($historic);
        }
    }


    /**
     * @param $url
     * @return string
     */
    public static function testGet($url){
        //TODO: Remove ?
        $project = self::get($url);

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
     * @param Wx_User $user
     * @return bool
     */
    public static function hasProjects(Wx_User $user){
        return !empty(self::getOwnerProjects($user));
    }

    /**
     * @param Wx_User $user
     * @param bool|false $little
     * @return string
     */
    public static function showAllProjectsTable(Wx_User $user, $little=false){
        //TODO: Remove, old function, now we use Twig
        $allProjects = self::getOwnerProjects($user);

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
            if($value['owner'] == $user->getId()){
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

    /**
     * @param Wx_User $user
     * @return array
     */
    public static function getUserProjects(Wx_User $user){
        $q = Wx_Query::query(
            "
                SELECT *
                FROM projects_users pu
                JOIN projects p
                ON pu.project_id = p.id
                WHERE pu.user_id = :id
                AND p.owner != pu.user_id
            ",
            [
                'id' => $user->getId(),
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

    /**
     * @param $project_id
     * @return Wx_Project_PUsers
     */
    public static function getProjectUsers($project_id){
        $q = Wx_Query::query(
            "
                SELECT pu.*, u.name
                FROM projects_users pu JOIN users u
                 ON u.id = pu.user_id
                WHERE pu.project_id = :id
            ",
            [
                'id' => $project_id,
            ]
        );

        $users = new Wx_Project_PUsers();
        while($data = $q->fetch()){
            $users->addUser($data['id'], $data['user_id'], $data['access'], $data['date_added'], $data['name']);
        }

        return $users;
    }

    /**
     * @param Wx_User $user
     * @return array
     */
    public static function getOwnerProjects(Wx_User $user){
        $q = Wx_Query::query(
            "
                SELECT *
                FROM projects
                WHERE owner = :owner
            ",
            [
                'owner' => $user->getId(),
            ]
        );

        $i=0;
        $return = [];

        while($result = $q->fetch()){
            $return[$i] = new Wx_Project(
                $result['app_id'],
                $result['name'],
                $result['owner'],
                $result['type'],
                $result['description'],
                $result['url'],
                $result['date_creation'],
                $result['date_modification'],
                $result['public']
            );
            $i++;
        }

        return $return;
    }

    /**
     * @param Wx_User $user
     * @return array
     */
    public static function getAllUserProjects(Wx_User $user){
        $projects = self::getOwnerProjects($user);
        $projectsUser = self::getUserProjects($user);
        return array_merge($projects, $projectsUser);
    }


    public static function getAllPublicProjects(){
        $q = Wx_Query::query(
            "
                SELECT *
                FROM projects
                WHERE public = TRUE
            ", []
        );

        $return = [];
        while($data = $q->fetch()){
            $return[] = new Wx_Project(
                $data['app_id'],
                $data['name'],
                $data['owner'],
                $data['type'],
                $data['description'],
                $data['url'],
                $data['date_creation'],
                $data['date_modification'],
                $data['public'],
                $data['id']
            );
        }

        return $return;
    }

    /**
     * @return array
     */
    public static function getAllProjects(){
        $q = Wx_Query::query(
            "
                SELECT *
                FROM projects
            ", []
        );

        $return = [];
        while($data = $q->fetch()){
            $return[] = new Wx_Project(
                $data['app_id'],
                $data['name'],
                $data['owner'],
                $data['type'],
                $data['description'],
                $data['url'],
                $data['date_creation'],
                $data['date_modification'],
                $data['public'],
                $data['id']
            );
        }

        return $return;
    }

    /**
     * @return array
     */
    /*public function getAllProjects(){
        TODO: Remove?
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