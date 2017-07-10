<?php

class Index_controller extends BServiceController {

    function __construct() {
        parent::__construct();
    }

    public function getIndex() {
        $arr = ["ñame"=>'pepé'];
        print json_encode($arr);
    }

	public function getWelcome(){
		$welcome = Home::getAll();
		//print 'asdasdadasds';
		print json_encode($welcome[0]);
	}

    public function getAuditoriums($inuId){
        $auditorio = Auditorios::where("ID_AUDIENCE", $inuId);

		foreach ($auditorio as &$valor) {
			$valor[SCHEDULES] = json_decode($valor[SCHEDULES]);
		}

        //$auditorio = Auditorios::getID_AUDIENCE($inuId);
        if (!empty($auditorio) || is_array($auditorio)) {
            print json_encode($auditorio);

        } else {
            print json_encode($auditorio->toArray());
        }
    }

    // Trae todos los edificios
    public function getBuildings(){
        $buildings = Edificiosauditorios::getAll();

        if (!empty($buildings) || is_array($buildings)) {
            print json_encode($buildings);
            
        } else {
            print json_encode($buildings->toArray());
        }
    }

    public function getCourses($isbSearchString){
        $buildings = Auditorios::searchFor("DESCRIPTION", $isbSearchString);
        //$auditorio = Auditorios::getID_AUDIENCE($inuId);
        if (!empty($buildings) || is_array($buildings)) {
            print json_encode($buildings);
            
        } else {
            print json_encode($buildings->toArray());
        }
    }

    // --- DIRECTORY ---

       public function getUnits($id=false){
		   // *** ESTA TABLA SIGUE DANDO PROBLEMAS CON TILDES!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		$Unidades = Unidades::getAll();

		if (!empty($Unidades) || is_array($Unidades)) {
			print json_encode($Unidades);
			
		} else {
			print json_encode($Unidades->toArray());
		}
		//print '???';
		//print_r($Unidades);
		//print json_encode($Unidades);
            /*print '[{"ID":1,"DESCRIPTION":"Rectoría"},{"ID":2,"DESCRIPTION":"Secretaría"},
{"ID":3,"DESCRIPTION":"Vicerrectorías"},{"ID":4,"DESCRIPTION":"Facultades"},{"ID":5,"DESCRIPTION":"Unidades de Rectoría y Secretaría"},
{"ID":6,"DESCRIPTION":"Unidades Académicas"},{"ID":7,"DESCRIPTION":"Unidades Administrativas"},
{"ID":8,"DESCRIPTION":"Otras dependencias"}]';*/
    }

   public function getDependencies($inuId){
       $auditorio = Directorio::where("UNIT_ID", $inuId);

        if (!empty($auditorio) || is_array($auditorio)) {
            print json_encode($auditorio);

        } else {
           print json_encode($auditorio->toArray());
        }
    }

    public function getDependenciesSearch($isbSearchString){
        $buildings = Directorio::searchFor("DESCRIPTION", $isbSearchString);

        if (!empty($buildings) || is_array($buildings)) {
            print json_encode($buildings);
            
        } else {
            print json_encode($buildings->toArray());
        }
    }

    // --- PLANES DE ESTUDIOS ---

     public function getFaculties($id=false){
		 $buildings = Facultades::getAll();
	   
	   foreach ($buildings as &$valor) {
			$valor = json_decode($valor[OBJECT]);
		}

        if (!empty($buildings) || is_array($buildings)) {
            print json_encode($buildings);
            
        } else {
            print json_encode($buildings->toArray());
        }
    }

    public function getCarrers($inuId){
		$auditorio = Carreras::where("TYPE", $inuId);
		//$auditorio = Carreras::where("ID_FACULTY", $inuId);
	   
	   foreach ($auditorio as &$valor) {
			$valor = json_decode($valor[SEMESTERS]);
		}

		/*print 'inuId=' . $inuId . '-   ';*/
		//print_r($auditorio);

        if (!empty($auditorio) || is_array($auditorio)) {
            print json_encode($auditorio);
            
        } else {
            print json_encode($auditorio->toArray());
        }
    }

    public function getCarrersSearch($isbSearchString){
       $buildings = Carreras::searchFor("NAME", $isbSearchString);
	   
	   foreach ($buildings as &$valor) {
			$valor = json_decode($valor[SEMESTERS]);
		}

        if (!empty($buildings) || is_array($buildings)) {
            print json_encode($buildings);
            
        } else {
            print json_encode($buildings->toArray());
        }
    }

	public function getCoursesSearch($isbSearchString){
        // *** ESTA TABLA SIGUE DANDO PROBLEMAS CON TILDES!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		$buildings = Courses::search("courses", "*", "DESCRIPTION LIKE '%".$isbSearchString."%' OR TEACHER LIKE '%".$isbSearchString."%'");

		foreach ($buildings as &$valor) {
			$valor[SCHEDULES] = json_decode($valor[SCHEDULES]);
		}

        if (!empty($buildings) || is_array($buildings)) {
            print json_encode($buildings);
            
        } else {
            print json_encode($buildings->toArray());
        }
    }
	
	public function getMapData(){
		$Map = Map::getAll();

		foreach ($Map as &$valor) {
			$rfg = Mapextrainfo::search("mapextrainfo","DESCRIPTION","PARENT_ID=" . $valor[ID]);
			// $valor es un arreglo
			$valor[PLACES] = $rfg;
		}

		//$return es un objeto
		$return = new stdClass();
		$return->MAP = "map.svg";
		$return->BASE_LAYER = "allGray.svg";
		$return->LOCATION = "mark.svg";
		$return->LAYERS = $Map;

		print json_encode($return);
    }

	public function getMapPlaces($arMapPoints){
		foreach ($arMapPoints as &$valor) {
			$rfg = Mapextrainfo::search("mapextrainfo","DESCRIPTION","PARENT_ID=" . $valor[ID]);
			// $valor es un arreglo
			$valor[PLACES] = $rfg;
		}

		return $arMapPoints;
	}

	public function getMapSearch($isbSearchString){
		$places = Mapextrainfo::searchFor("DESCRIPTION", $isbSearchString);

		//$sql = 'SELECT * FROM map WHERE DESCRIPTION LIKE "%' . $isbSearchString . '%"';
		$sql = 'DESCRIPTION LIKE "%' . $isbSearchString . '%"';
		$counter = true;

		foreach ($places as &$valor) {
			// $valor es un arreglo
			$sql = $sql . ' OR ID=' . $valor[PARENT_ID];
		}

		//print json_encode($sql);

		$rfg = Map::search("map","*",$sql);

		$result = self::getMapPlaces($rfg);
		print json_encode($result);
    }
}
