<?php

/**
* Class Quioscos generated by Chrysalis v.1.0.0
* 
* Chrysalis info:
* @author pabhoz
* github: @pabhoz
* bitbucket: @pabhoz
* 
*/ 
 
class Quioscos extends BModel {

    private $ID;
    private $Nombre;

    public function __construct( int $ID, string $Nombre) {

        parent::__construct();
        $this->ID = $ID;
        $this->Nombre = $Nombre;
    }

    public function getID(): int {
        return $this->ID;
    }

    public function getNombre(): string {
        return $this->Nombre;
    }

    public function setID(int $ID) {
        $this->ID = $ID;
    }

    public function setNombre(string $Nombre) {
        $this->Nombre = $Nombre;
    }

    public function getMyVars(){
        return get_object_vars($this);
    }

}