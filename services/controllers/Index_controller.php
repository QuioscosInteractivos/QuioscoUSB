<?php

class Index_controller extends BServiceController {

    function __construct() {
        parent::__construct();
    }

    public function getIndex() {
        $arr = ["ñame"=>'pepé'];
        print json_encode($arr);
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

		/*print '[{
	"ID": 5,
	"DESCRIPTION": "Sala 1",
	"ID_AUDIENCE": 4,
	"SCHEDULES": [{
		"ID": 6553,
		"DESCRIPTION": "Física I",
		"TEACHER": "Walter Magaña",
		"STARTS_AT": "7:00 AM",
		"ENDS_AT": "10:00 AM"
	}, {
		"ID": 856,
		"DESCRIPTION": "Física II",
		"TEACHER": "Walter Magaña",
		"STARTS_AT": "11:00 AM",
		"ENDS_AT": "1:00 PM"
	}, {
		"ID": 741,
		"DESCRIPTION": "Circuitos I",
		"TEACHER": "Ivan Lasso",
		"STARTS_AT": "1:00 PM",
		"ENDS_AT": "5:00 PM"
	}, {
		"ID": 958,
		"DESCRIPTION": "Web I",
		"TEACHER": "Pablo Bejarano",
		"STARTS_AT": "5:00 PM",
		"ENDS_AT": "10:00 PM"
	}]
}, {
	"ID": 86,
	"DESCRIPTION": "Sala 2",
	"ID_AUDIENCE": 4,
	"SCHEDULES": [{
		"ID": 45,
		"DESCRIPTION": "Gestión de proyectos",
		"TEACHER": "Andrés Calderón",
		"STARTS_AT": "7:00 AM",
		"ENDS_AT": "10:00 AM"
	}]
}]';*/
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
        /*$buildings = Directorio::searchFor("DESCRIPTION", $isbSearchString);
        if (!empty($buildings) || is_array($buildings)) {
            print json_encode($buildings);
            
        } else {
            print json_encode($buildings->toArray());
        }*/

		print '[{
	"ID": 5,
	"DESCRIPTION": "Física II",
	"TEACHER": "Walter Magaña",
	"SCHEDULES": [{
		"DAY": "Lunes",
		"SCHEDULES": []
		}, {
			"DAY": "Martes",
			"SCHEDULES": [{
				"ID": 741,
				"BUILDING": "Farallones",
				"CLASSROOM": "Sala 3",
				"STARTS_AT": "10:00 AM",
				"ENDS_AT": "12:00 PM"
			}]
		}, {
			"DAY": "Miercoles",
			"SCHEDULES": [{
				"ID": 958,
				"BUILDING": "Farallones",
				"CLASSROOM": "Sala 4",
				"STARTS_AT": "5:00 PM",
				"ENDS_AT": "10:00 PM"
			}]
		}, {
			"DAY": "Jueves",
			"SCHEDULES": []
		}, {
			"DAY": "Viernes",
			"SCHEDULES": [{
				"ID": 45,
				"BUILDING": "Farallones",
				"CLASSROOM": "Sala 4",
				"STARTS_AT": "7:00 AM",
				"ENDS_AT": "10:00 AM"
			}]
		}, {
			"DAY": "Sabado",
			"SCHEDULES": []
		}]
}, {
	"ID": 78,
	"DESCRIPTION": "Métodos numéricos",
	"TEACHER": "Walter Magaña",
	"SCHEDULES": [{
		"DAY": "Lunes",
		"SCHEDULES": [{
				"ID": 6553,
				"BUILDING": "Farallones",
				"CLASSROOM": "Sala 4",
				"STARTS_AT": "7:00 AM",
				"ENDS_AT": "10:00 AM"
			}, {
				"ID": 856,
				"BUILDING": "Farallones",
				"CLASSROOM": "Sala 4",
				"STARTS_AT": "11:00 AM",
				"ENDS_AT": "1:00 PM"
			}]
		}, {
			"DAY": "Martes",
			"SCHEDULES": [{
				"ID": 741,
				"BUILDING": "Farallones",
				"CLASSROOM": "Sala 4",
				"STARTS_AT": "1:00 PM",
				"ENDS_AT": "5:00 PM"
			}]
		}, {
			"DAY": "Miercoles",
			"SCHEDULES": []
		}, {
			"DAY": "Jueves",
			"SCHEDULES": [{
				"ID": 45,
				"BUILDING": "Farallones",
				"CLASSROOM": "Sala 4",
				"STARTS_AT": "7:00 AM",
				"ENDS_AT": "10:00 AM"
			}]
		}, {
			"DAY": "Viernes",
			"SCHEDULES": []
		}, {
			"DAY": "Sabado",
			"SCHEDULES": []
		}]
}]';
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
