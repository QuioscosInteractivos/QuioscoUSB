<?php

/**
* @author Leonardo Arcos
*/ 
 
class Mapextrainfo extends BModel {

    private $ID;
    private $PARENT_ID;
    private $DESCRIPTION;

    public function __construct( $ID,  int $PARENT_ID, string $DESCRIPTION) {

        parent::__construct();
        $this->ID = $ID;
        $this->PARENT_ID = $PARENT_ID;
        $this->DESCRIPTION = $DESCRIPTION;
    }

    public function getID() {
        return $this->ID;
    }

    public function getPARENT_ID() {
        return $this->PARENT_ID;
    }

    public function getDESCRIPTION() {
        return $this->DESCRIPTION;
    }

    public function setID(int $ID) {
        $this->ID = $ID;
    }

    public function setPARENT_ID(int $PARENT_ID) {
        $this->PARENT_ID = $PARENT_ID;
    }

    public function setDESCRIPTION(string $DESCRIPTION) {
        $this->DESCRIPTION = $DESCRIPTION;
    }

    public function getMyVars(){
        return get_object_vars($this);
    }

}