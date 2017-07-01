<?php

/**
* Class Carreras generated by Chrysalis v.1.0.0
* 
* Chrysalis info:
* @author pabhoz
* github: @pabhoz
* bitbucket: @pabhoz
* 
*/ 
 
class Carreras extends BModel {

    private $ID;
    private $NAME;
    private $TYPE;
    private $SEMESTERS;
    private $ID_FACULTY;

    public function __construct( $ID,  string $NAME, int $TYPE, string $SEMESTERS, int $ID_FACULTY) {

        parent::__construct();
        $this->ID = $ID;
        $this->NAME = $NAME;
        $this->TYPE = $TYPE;
        $this->SEMESTERS = $SEMESTERS;
        $this->ID_FACULTY = $ID_FACULTY;
    }

    public function getID(){
        return $this->ID;
    }

    public function getNAME(){
        return $this->NAME;
    }

    public function getTYPE(){
        return $this->TYPE;
    }

    public function getSEMESTERS() {
        return $this->SEMESTERS;
    }

    public function getID_FACULTY(){
        return $this->ID_FACULTY;
    }

    public function setID(int $ID) {
        $this->ID = $ID;
    }

    public function setNAME(string $NAME) {
        $this->NAME = $NAME;
    }

    public function setTYPE(int $TYPE) {
        $this->TYPE = $TYPE;
    }

    public function setSEMESTERS(string $SEMESTERS) {
        $this->SEMESTERS = $SEMESTERS;
    }

    public function setID_FACULTY(int $ID_FACULTY) {
        $this->ID_FACULTY = $ID_FACULTY;
    }

    public function getMyVars(){
        return get_object_vars($this);
    }

}