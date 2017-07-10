<?php

/**
* @author Leonardo Arcos
*/ 
 
class Courses extends BModel {

    private $ID;
    private $DESCRIPTION;
    private $TEACHER;
    private $SEMESTERS;

    public function __construct(int $ID,  string $DESCRIPTION, string $TEACHER, string $SEMESTERS) {

        parent::__construct();
        $this->ID = $ID;
        $this->DESCRIPTION = $DESCRIPTION;
        $this->TEACHER = $TEACHER;
        $this->SEMESTERS = $SEMESTERS;
    }

    public function getID(){
        return $this->ID;
    }

    public function getDESCRIPTION(){
        return $this->DESCRIPTION;
    }

    public function getTEACHER(){
        return $this->TEACHER;
    }

    public function getSEMESTERS(){
        return $this->SEMESTERS;
    }

    public function setID(int $ID) {
        $this->ID = $ID;
    }

    public function setDESCRIPTION(string $DESCRIPTION) {
        $this->DESCRIPTION = $DESCRIPTION;
    }

    public function setTEACHER(string $TEACHER) {
        $this->TEACHER = $TEACHER;
    }

    public function setSEMESTERS(string $SEMESTERS) {
        $this->SEMESTERS = $SEMESTERS;
    }

    public function getMyVars(){
        return get_object_vars($this);
    }

}