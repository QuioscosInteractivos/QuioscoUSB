<?php

/**
* @author Leonardo Arcos
*/ 
 
class Home extends BModel {

    private $ID;
    private $TITLE;
    private $SUBTITLE;
    private $WELCOME;

    public function __construct(int $ID, string $TITLE, string $SUBTITLE, string $WELCOME) {

        parent::__construct();
        $this->$ID = $ID;
        $this->TITLE = $TITLE;
        $this->SUBTITLE = $SUBTITLE;
        $this->WELCOME = $WELCOME;
    }

    public function getID(){
        return $this->ID;
    }

    public function getTITLE(){
        return $this->TITLE;
    }

    public function getSUBTITLE(){
        return $this->SUBTITLE;
    }

    public function getWELCOME(){
        return $this->WELCOME;
    }

    public function setID(int $ID) {
        $this->ID = $ID;
    }

    public function setTITLE(string $TITLE) {
        $this->TITLE = $TITLE;
    }

    public function setSUBTITLE(string $SUBTITLE) {
        $this->SUBTITLE = $SUBTITLE;
    }

    public function setWELCOME(string $WELCOME) {
        $this->WELCOME = $WELCOME;
    }

    public function getMyVars(){
        return get_object_vars($this);
    }

}