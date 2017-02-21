<?php

/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 31.01.2017
 */

class Wx_Apps_Print3d implements Wx_Apps_iApps{
    private $_id;
    private $_project_id;
    private $_printer_id;
    private $_result_id;
    private $_timelapse_id;
    private $_stl_id;
    private $_gcode_id;
    private $_infos;
    private $_parsedInfos;

    /**
     * Wx_Apps_Print3d constructor.
     * @param $_id
     * @param $_project_id
     * @param $_printer_id
     * @param $_result_id
     * @param $_timelapse_id
     * @param $_stl_id
     * @param $_gcode_id
     * @param $_infos
     */
    public function __construct($_id, $_project_id, $_printer_id, $_result_id, $_timelapse_id, $_stl_id, $_gcode_id, $_infos)
    {
        $this->_id = $_id;
        $this->_project_id = $_project_id;
        $this->_printer_id = $_printer_id;
        $this->_result_id = $_result_id;
        $this->_timelapse_id = $_timelapse_id;
        $this->_stl_id = $_stl_id;
        $this->_gcode_id = $_gcode_id;
        $this->_infos = $_infos;
    }

    /**
     * @return int
     */
    public function getId(){
        return $this->_id;
    }

    /**
     * @param int $id
     */
    public function setId($id){
        $this->_id = $id;
    }

    /**
     * @return int
     */
    public function getProjectId(){
        return $this->_project_id;
    }

    /**
     * @param int $project_id
     */
    public function setProjectId($project_id){
        $this->_project_id = $project_id;
    }

    /**
     * @return int
     */
    public function getPrinterId(){
        return $this->_printer_id;
    }

    /**
     * @param int $printer_id
     */
    public function setPrinterId($printer_id){
        $this->_printer_id = $printer_id;
    }

    /**
     * @return int
     */
    public function getResultId(){
        return $this->_result_id;
    }

    /**
     * @param mixed $result_id
     */
    public function setResultId($result_id){
        $this->_result_id = $result_id;
    }

    /**
     * @return int
     */
    public function getTimelapseId(){
        return $this->_timelapse_id;
    }

    /**
     * @param int $timelapse_id
     */
    public function setTimelapseId($timelapse_id){
        $this->_timelapse_id = $timelapse_id;
    }

    /**
     * @return int
     */
    public function getStlId(){
        return $this->_stl_id;
    }

    /**
     * @param int $stl_id
     */
    public function setStlId($stl_id){
        $this->_stl_id = $stl_id;
    }

    /**
     * @return int
     */
    public function getGcodeId(){
        return $this->_gcode_id;
    }

    /**
     * @param int $gcode_id
     */
    public function setGcodeId($gcode_id){
        $this->_gcode_id = $gcode_id;
    }

    /**
     * @return int
     */
    public function getInfos(){
        return $this->_infos;
    }

    /**
     * @param int $infos
     */
    public function setInfos($infos){
        $this->_infos = $infos;
    }

    /**
     * @return string
     */
    public function getParsedInfos(){
        $Parsedown = new Parsedown();

        if($this->_parsedInfos == null)
            $this->_parsedInfos = $Parsedown->text($this->_infos);

        return $this->_parsedInfos;
    }

    public function getType(){
        return 'print3d';
    }
}