<?php

/**
* @author Leonardo Arcos
*/ 
 
class Map extends BModel {

    private $ID;
    private $NUMBER;
    private $DESCRIPTION;
    private $IMG;

    public function __construct( $ID,  int $NUMBER, string $DESCRIPTION, string $IMG) {

        parent::__construct();
        $this->ID = $ID;
        $this->NUMBER = $NUMBER;
        $this->DESCRIPTION = $DESCRIPTION;
        $this->IMG = $IMG;
    }

    public function getID() {
        return $this->ID;
    }

    public function getNUMBER() {
        return $this->NUMBER;
    }

    public function getDESCRIPTION() {
        return $this->DESCRIPTION;
    }

    public function getIMG() {
        return $this->IMG;
    }

    public function setID(int $ID) {
        $this->ID = $ID;
    }

    public function setNUMBER(string $NUMBER) {
        $this->NUMBER = $NUMBER;
    }

    public function setDESCRIPTION(string $DESCRIPTION) {
        $this->DESCRIPTION = $DESCRIPTION;
    }

    public function setIMG(string $IMG) {
        $this->IMG = $IMG;
    }

    public function getMyVars(){
        return get_object_vars($this);
    }

}