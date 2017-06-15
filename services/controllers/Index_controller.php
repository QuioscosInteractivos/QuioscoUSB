<?php

class Index_controller extends BServiceController {

    function __construct() {
        parent::__construct();
    }

    public function getIndex() {
        $arr = ["ñame"=>'pepé'];
        print json_encode($arr);
    }

    public function postIndex() {
        Request::setHeader(200, "text/html");
        echo "Post method Index controller";
    }

    public function getSaludo($nombre, $apellido) {
        if (!isset($nombre) || !isset($apellido)) {
            throw new Exception('Paremetros insuficientes.');
        }
        Request::setHeader(200, "text/plain");
        echo "Hey " . $nombre . " " . $apellido . "!";
    }
    
    public function getAuditorios($id=false){
        if($id){
            $auditorio = Auditorios::getById($id);
            print json_encode($auditorio->toArray());
        }else{
            $auditorios = Auditorios::getAll();
            print json_encode($auditorios);
        }
    }
    
    public function getAuditoriosByName($name){
        $auditorio = Auditorios::getBy("DESCRIPTION", $name);
        print json_encode($auditorio);
    }

    public function getAuditoriums($inuId){
        $auditorio = Auditorios::where("ID_AUDIENCE", $inuId);
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
        //$auditorio = Auditorios::getID_AUDIENCE($inuId);
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
        /*if($id){
            $Unidades = Unidades::getById($id);
            print json_encode($Unidades->toArray());
        }else{
            $Unidades = Unidades::getAll();
            print json_encode($Unidades);
        }*/

		print 'hgujgj';
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

    // --- PLANES DE ESTUDIOs ---

     public function getFaculties($id=false){
        /*if($id){
            $Unidades = Facultades::getById($id);
            print json_encode($Unidades->toArray());
        }else{*/
            $Unidades = Facultades::getAll();
            //print json_encode($Unidades);
            print $Unidades;
        //}

        /*print '[{
					"NAME": "Cálculo diferencial",
					"ID":1008,
					"ID_GROUPER":1,
					"CREDITS":3
				}]';*/
    }

    public function getCarrers($inuId){
        $auditorio = Carreras::where("ID_FACULTY", $inuId);
        /*if (!empty($auditorio) || is_array($auditorio)) {
            print json_encode($auditorio);

        } else {
            print json_encode($auditorio->toArray());
        }*/

        print json_encode('[{
	"NAME":"Ingeniería Multimedia",
	"GROUPERS":[{"DESCRIPTION":"Ciencias básicas", "ID":1},{"DESCRIPTION":"Ciencias básicas en ingeniería", "ID":2},{"DESCRIPTION":"Ingeniería aplicada", "ID":3},{"DESCRIPTION":"Complementaria", "ID":4}],
	"SEMESTERS":[
		{
			"ID_SEMESTER":1,
			"SEMESTER_NAME":"Semestre 1",
			"TOTAL_CREDITS":20,
			"SUBJECTS":[
				{
					"NAME": "Precálculo",
					"ID":1000,
					"ID_GROUPER":1,
					"CREDITS":3
				},
				{
					"NAME":"Lógica",
					"ID":1001,
					"ID_GROUPER":2,
					"CREDITS":4
				},
				{
					"NAME":"Introducción a la ingeniería",
					"ID":1002,
					"ID_GROUPER":2,
					"CREDITS":3
				},
				{
					"NAME":"Diseño para medios digitales",
					"ID":1003,
					"ID_GROUPER":3,
					"CREDITS":2
				},
				{
					"NAME":"Taller multimedia",
					"ID":1004,
					"ID_GROUPER":3,
					"CREDITS":2
				},
				{
					"NAME":"Expresión oral y escrita",
					"ID":1005,
					"ID_GROUPER":4,
					"CREDITS":2
				},
				{
					"NAME":"Proyecto de vida",
					"ID":1006,
					"ID_GROUPER":4,
					"CREDITS":2
				},
				{
					"NAME":"Identidad institucional",
					"ID":1007,
					"ID_GROUPER":4,
					"CREDITS":2
				}

			]
		},{
			"ID_SEMESTER":2,
			"SEMESTER_NAME":"Semestre 2",
			"TOTAL_CREDITS":18,
			"SUBJECTS":[
				{
					"NAME": "Cálculo diferencial",
					"ID":1008,
					"ID_GROUPER":1,
					"CREDITS":3
				},
				{
					"NAME":"Álgebra lineal",
					"ID":1009,
					"ID_GROUPER":1,
					"CREDITS":4
				},
				{
					"NAME":"Introducción a la programación",
					"ID":1010,
					"ID_GROUPER":2,
					"CREDITS":3
				},
				{
					"NAME":"Dibujo para la ingeniería",
					"ID":1011,
					"ID_GROUPER":3,
					"CREDITS":2
				},
				{
					"NAME":"Guión y redacción para medios digitales",
					"ID":1012,
					"ID_GROUPER":3,
					"CREDITS":2
				},
				{
					"NAME":"Constitución y democracia",
					"ID":1013,
					"ID_GROUPER":4,
					"CREDITS":2
				},
				{
					"NAME":"Inglés básico",
					"ID":1014,
					"ID_GROUPER":4,
					"CREDITS":2
				}
			]
		},{
			"ID_SEMESTER":3,
			"SEMESTER_NAME":"Semestre 3",
			"TOTAL_CREDITS":18,
			"SUBJECTS":[
				{
					"NAME": "Física mecánica",
					"ID":1015,
					"ID_GROUPER":1,
					"CREDITS":3
				},
				{
					"NAME":"Cálculo integral",
					"ID":1016,
					"ID_GROUPER":1,
					"CREDITS":4
				},
				{
					"NAME":"Programción avanzada",
					"ID":1017,
					"ID_GROUPER":2,
					"CREDITS":3
				},
				{
					"NAME":"Taller de animación 2D",
					"ID":1018,
					"ID_GROUPER":3,
					"CREDITS":3
				},
				{
					"NAME":"Taller de video y fotografía",
					"ID":1019,
					"ID_GROUPER":3,
					"CREDITS":2
				},
				{
					"NAME":"Franciscanismo y ecología",
					"ID":1020,
					"ID_GROUPER":4,
					"CREDITS":2
				},
				{
					"NAME":"Inglés de acceso",
					"ID":1021,
					"ID_GROUPER":4,
					"CREDITS":2
				}
			]
		},{
			"ID_SEMESTER":4,
			"SEMESTER_NAME":"Semestre 4",
			"TOTAL_CREDITS":16,
			"SUBJECTS":[
				{
					"NAME": "Física electromagnética",
					"ID":1022,
					"ID_GROUPER":1,
					"CREDITS":2
				},
				{
					"NAME":"Cálculo multivariado",
					"ID":1023,
					"ID_GROUPER":1,
					"CREDITS":3
				},
				{
					"NAME":"Geometría vectorial",
					"ID":1024,
					"ID_GROUPER":1,
					"CREDITS":3
				},
				{
					"NAME":"Estructura de datos",
					"ID":1025,
					"ID_GROUPER":2,
					"CREDITS":2
				},
				{
					"NAME":"Modelado y animación 3D",
					"ID":1026,
					"ID_GROUPER":3,
					"CREDITS":4
				},
				{
					"NAME":"Ingles de plataforma",
					"ID":1027,
					"ID_GROUPER":4,
					"CREDITS":2
				}
			]
		},{
			"ID_SEMESTER":5,
			"SEMESTER_NAME":"Semestre 5",
			"TOTAL_CREDITS":16,
			"SUBJECTS":[
				{
					"NAME": "Ecuaciones diferenciales",
					"ID":1028,
					"ID_GROUPER":1,
					"CREDITS":3
				},
				{
					"NAME":"Probabilidad y estadística",
					"ID":1029,
					"ID_GROUPER":1,
					"CREDITS":2
				},
				{
					"NAME":"Computación gráfica",
					"ID":1030,
					"ID_GROUPER":3,
					"CREDITS":3
				},
				{
					"NAME":"Fundamentos de base de datos",
					"ID":1031,
					"ID_GROUPER":3,
					"CREDITS":3
				},
				{
					"NAME":"Organizaciones",
					"ID":1032,
					"ID_GROUPER":3,
					"CREDITS":2
				},
				{
					"NAME":"Diseño de sistemas mutimedia",
					"ID":1033,
					"ID_GROUPER":3,
					"CREDITS":3
				}
			]
		},{
			"ID_SEMESTER":6,
			"SEMESTER_NAME":"Semestre 6",
			"TOTAL_CREDITS":18,
			"SUBJECTS":[
				{
					"NAME": "Métodos numéricos",
					"ID":1034,
					"ID_GROUPER":2,
					"CREDITS":3
				},
				{
					"NAME":"Integración y composición en desarrollo de videojuegos en 3D",
					"ID":1035,
					"ID_GROUPER":3,
					"CREDITS":3
				},
				{
					"NAME":"Electiva complementaria I",
					"ID":1036,
					"ID_GROUPER":3,
					"CREDITS":2
				},
				{
					"NAME":"Procesamiento de señales digitales",
					"ID":1037,
					"ID_GROUPER":3,
					"CREDITS":3
				},
				{
					"NAME":"Bases de datos multimedia",
					"ID":1038,
					"ID_GROUPER":3,
					"CREDITS":2
				},
				{
					"NAME":"Proyecto integrador",
					"ID":1039,
					"ID_GROUPER":3,
					"CREDITS":3
				},
				{
					"NAME":"Ética",
					"ID":1040,
					"ID_GROUPER":4,
					"CREDITS":2
				}
			]
		},{
			"ID_SEMESTER":7,
			"SEMESTER_NAME":"Semestre 7",
			"TOTAL_CREDITS":15,
			"SUBJECTS":[
				{
					"NAME": "Audio digital para multimedia",
					"ID":1041,
					"ID_GROUPER":3,
					"CREDITS":2
				},
				{
					"NAME":"Procesamiento de imágenes digitales",
					"ID":1042,
					"ID_GROUPER":3,
					"CREDITS":3
				},
				{
					"NAME":"Circuitos dígitales",
					"ID":1043,
					"ID_GROUPER":3,
					"CREDITS":2
				},
				{
					"NAME":"Fundamentos de redes",
					"ID":1044,
					"ID_GROUPER":3,
					"CREDITS":2
				},
				{
					"NAME":"Electiva complementaria II",
					"ID":1045,
					"ID_GROUPER":3,
					"CREDITS":2
				},
				{
					"NAME":"Electiva profundización I",
					"ID":1046,
					"ID_GROUPER":3,
					"CREDITS":2
				},
				{
					"NAME":"Electiva humanística I",
					"ID":1047,
					"ID_GROUPER":4,
					"CREDITS":2
				}
			]
		},{
			"ID_SEMESTER":8,
			"SEMESTER_NAME":"Semestre 8",
			"TOTAL_CREDITS":16,
			"SUBJECTS":[
				{
					"NAME": "Postproducción de video",
					"ID":1048,
					"ID_GROUPER":3,
					"CREDITS":2
				},
				{
					"NAME":"Electrónica multimedia",
					"ID":1049,
					"ID_GROUPER":3,
					"CREDITS":2
				},
				{
					"NAME":"Cátedra de emprendimiento",
					"ID":1050,
					"ID_GROUPER":3,
					"CREDITS":2
				},
				{
					"NAME":"Trabajo de grado",
					"ID":1051,
					"ID_GROUPER":3,
					"CREDITS":4
				},
				{
					"NAME":"Electiva profundización II",
					"ID":1052,
					"ID_GROUPER":3,
					"CREDITS":2
				},
				{
					"NAME":"Electiva libre I",
					"ID":1053,
					"ID_GROUPER":4,
					"CREDITS":2
				},
				{
					"NAME":"Electiva humanística II",
					"ID":1054,
					"ID_GROUPER":4,
					"CREDITS":2
				}
			]
		},{
			"ID_SEMESTER":9,
			"SEMESTER_NAME":"Semestre 9",
			"TOTAL_CREDITS":12,
			"SUBJECTS":[
				{
					"NAME": "Legislación multimedia",
					"ID":1055,
					"ID_GROUPER":3,
					"CREDITS":2
				},
				{
					"NAME":"Práctica profesional",
					"ID":1056,
					"ID_GROUPER":3,
					"CREDITS":4
				},
				{
					"NAME":"Electiva profundización III",
					"ID":1057,
					"ID_GROUPER":3,
					"CREDITS":2
				},
				{
					"NAME":"Electiva libre II",
					"ID":1058,
					"ID_GROUPER":3,
					"CREDITS":2
				},
				{
					"NAME":"Electiva humanística III",
					"ID":1059,
					"ID_GROUPER":3,
					"CREDITS":2
				}
			]
		}
	]
}]'->toArray());
    }

    public function getCarrersSearch($isbSearchString){
        $buildings = Carreras::searchFor("NAME", $isbSearchString);
        if (!empty($buildings) || is_array($buildings)) {
            print json_encode($buildings);
            
        } else {
            print json_encode($buildings->toArray());
        }
    }
}
