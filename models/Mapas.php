<?php

/**
* Class Mapas generated by Chrysalis v.1.0.0
* 
* Chrysalis info:
* @author pabhoz
* github: @pabhoz
* bitbucket: @pabhoz
* 
*/ 
 
class Mapas extends BModel {

    private $TYPE;
    private $IMAGE;
    private $ID;

    public function __construct( int $TYPE, string $IMAGE, int $ID) {

        parent::__construct();
        $this->TYPE = $TYPE;
        $this->IMAGE = $IMAGE;
        $this->ID = $ID;
    }

    public function getTYPE(): int {
        return $this->TYPE;
    }

    public function getIMAGE(): string {
        return $this->IMAGE;
    }

    public function getID(): int {
        return $this->ID;
    }

    public function setTYPE(int $TYPE) {
        $this->TYPE = $TYPE;
    }

    public function setIMAGE(string $IMAGE) {
        $this->IMAGE = $IMAGE;
    }

    public function setID(int $ID) {
        $this->ID = $ID;
    }

    public function getMyVars(){
        return get_object_vars($this);
    }

}