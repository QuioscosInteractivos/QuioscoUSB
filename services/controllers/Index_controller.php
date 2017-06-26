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
        /*$auditorio = Auditorios::where("ID_AUDIENCE", $inuId);
        //$auditorio = Auditorios::getID_AUDIENCE($inuId);
        if (!empty($auditorio) || is_array($auditorio)) {
            print json_encode($auditorio);

        } else {
            print json_encode($auditorio->toArray());
        }*/

		print '[{
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
}]';
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
        if($id){
           // $Unidades = Unidades::getById($id);
           // print json_encode($Unidades->toArray());
            print "dddffd";
        }else{
            //$Unidades = Unidades::getAll();
            //print json_encode($Unidades);
            print '[{"ID":1,"DESCRIPTION":"Rectoría"},{"ID":2,"DESCRIPTION":"Secretaría"},
{"ID":3,"DESCRIPTION":"Vicerrectorías"},{"ID":4,"DESCRIPTION":"Facultades"},{"ID":5,"DESCRIPTION":"Unidades de Rectoría y Secretaría"},
{"ID":6,"DESCRIPTION":"Unidades Académicas"},{"ID":7,"DESCRIPTION":"Unidades Administrativas"},
{"ID":8,"DESCRIPTION":"Otras dependencias"}]';
        }
    }

   public function getDependencies($inuId){
       // $auditorio = Directorio::where("UNIT_ID", $inuId);
      // $auditorio = $inuId;
        if (!empty($auditorio) || is_array($auditorio)) {
            print json_encode($auditorio);

        } else {
           // print json_encode($auditorio->toArray());
           print '[
    {
        "ID":7,
        "UNIT_ID":7,
        "DESCRIPTION":"Departamento de Talento Humano",
        "EMAIL":"talentohumano@usbcali.edu.co",
        "PHONE":"488 22 22 ext 256"
    },{
        "ID":8,
        "UNIT_ID":7,
        "DESCRIPTION":"Departamento de Contabilidad",
        "EMAIL":"",
        "PHONE":"488 22 22 ext 260, 259, 261"
    },{
        "ID":9,
        "UNIT_ID":7,
        "DESCRIPTION":"Editorial Bonaventuriana",
        "EMAIL":"editorialbonaventuriana@usbcali.edu.co",
        "PHONE":"4882222 ext 274"
    },{
        "ID":10,
        "UNIT_ID":7,
        "DESCRIPTION":"Parque Tecnológico",
        "EMAIL":"parquetecnologico@usbcali.edu.co",
        "PHONE":"4882222 ext 290, 385"
    }
]';
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
           // $Unidades = Facultades::getAll();
            //print json_encode($Unidades);
            print '[
    {
        "ID":1,
        "NAME":"Arquitectura, Arte y Diseño",
		"SONS":[{"NAME":"Pregrados", "ID":"11"},{"NAME":"Maestrias", "ID":"12"}]
		
    },{
        "ID":2,
        "NAME":"Ciencias Económicas",
		"SONS":[{"NAME":"Pregrados", "ID":"21"},{"NAME":"Especializaciones", "ID":"22"},{"NAME":"Maestrias", "ID":"23"}]
    },{
        "ID":3,
        "NAME":"Derecho y Ciencias Políticas",
		"SONS":[{"NAME":"Pregrados", "ID":"31"},{"NAME":"Especializaciones", "ID":"32"},{"NAME":"Maestrias", "ID":"33"}]
    },{
        "ID":4,
        "NAME":"Educación",
		"SONS":[
			{"NAME":"Pregrados", "ID":"41"},
			{"NAME":"Especializaciones", "ID":"42"},
			{"NAME":"Maestrias", "ID":"43"},
			{"NAME":"Doctorados", "ID":"44"}
		]
    },{
        "ID":5,
        "NAME":"Ingeniería",
		"SONS":[
			{"NAME":"Pregrados", "ID":"51"},
			{"NAME":"Especializaciones", "ID":"52"},
			{"NAME":"Maestrias", "ID":"53"}
		]
    },{
        "ID":6,
        "NAME":"Psicología",
		"SONS":[
			{"NAME":"Pregrados", "ID":"61"},
			{"NAME":"Especializaciones", "ID":"62"},
			{"NAME":"Maestrias", "ID":"63"},
			{"NAME":"Doctorados", "ID":"64"}
			]
    }
]';
        //}

        /*print '[{
					"NAME": "Cálculo diferencial",
					"ID":1008,
					"ID_GROUPER":1,
					"CREDITS":3
				}]';*/
    }

    public function getCarrers($inuId){
        //$auditorio = Carreras::where("ID_FACULTY", $inuId);
        /*if (!empty($auditorio) || is_array($auditorio)) {
            print json_encode($auditorio);

        } else {
            print json_encode($auditorio->toArray());
        }*/

        print '[{
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
}]';
    }

    public function getCarrersSearch($isbSearchString){
       $buildings = Carreras::searchFor("NAME", $isbSearchString);
	   
		//$like= 'NAME LIKE "%' . $isbSearchString . '%"';
		//print $like;
		//$buildings = Carreras::search('carreras', 'OBJECT',$like);
		//print_r($buildings);
		//print $buildings;
		//print json_encode($buildings);
		//print_r(json_encode($buildings));

		/*$cosa = '[{
                "DESCRIPTION": "Ciencias básicas",
                "ID": 1
            }, {
                "DESCRIPTION": "Ciencias básicas en ingeniería",
                "ID": 2
            }, {
                "DESCRIPTION": "Ingeniería aplicada",
                "ID": 3
            }, {
                "DESCRIPTION": "Complementaria",
                "ID": 4
            }]';*/
		//print_r(json_encode($cosa));
		//print_r($cosa);


        if (!empty($buildings) || is_array($buildings)) {
            print json_encode($buildings);
            
        } else {
            print json_encode($buildings->toArray());
        }

		/*print '[{
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
}, {
    "NAME": "Ingeniería Industrial",
    "GROUPERS": [{
        "DESCRIPTION": "Ciencias básicas",
        "ID": 1
    }, {
        "DESCRIPTION": "Ciencias básicas en ingeniería",
        "ID": 2
    }, {
        "DESCRIPTION": "Ingeniería aplicada",
        "ID": 3
    }, {
        "DESCRIPTION": "Complementaria",
        "ID": 4
    }],
    "SEMESTERS": [{
                "ID_SEMESTER": 1,
                "SEMESTER_NAME": "Semestre 1",
                "TOTAL_CREDITS": 18,
                "SUBJECTS": [{
                        "NAME": "Precálculo",
                        "ID": 1000,
                        "ID_GROUPER": 1,
                        "CREDITS": 3
                    }, {
                        "NAME": "Química inorgánica",
                        "ID": 1060,
                        "ID_GROUPER": 1,
                        "CREDITS": 4
                    }, {
                        "NAME": "Introducción a la ingeniería",
                        "ID": 1002,
                        "ID_GROUPER": 2,
                        "CREDITS": 3
                    }, {
                        "NAME": "Inglés básico",
                        "ID": 1014,
                        "ID_GROUPER": 4,
                        "CREDITS": 2
                    }, {
                        "NAME": "Expresión oral y escrita",
                        "ID": 1005,
                        "ID_GROUPER": 4,
                        "CREDITS": 2
                    }, {
                        "NAME": "Proyecto de vida",
                        "ID": 1006,
                        "ID_GROUPER": 4,
                        "CREDITS": 2
                    }, {
                        "NAME": "Identidad institucional y franciscanismo",
                        "ID": 1007,
                        "ID_GROUPER": 4,
                        "CREDITS": 2
                    }

                ]
            }, {
                "ID_SEMESTER": 2,
                "SEMESTER_NAME": "Semestre 2",
                "TOTAL_CREDITS": 17,
                "SUBJECTS": [{
                    "NAME": "Cálculo diferencial",
                    "ID": 1008,
                    "ID_GROUPER": 1,
                    "CREDITS": 3
                }, {
                    "NAME": "Álgebra lineal",
                    "ID": 1009,
                    "ID_GROUPER": 1,
                    "CREDITS": 4
                }, {
                    "NAME": "Química de los materiales",
                    "ID": 1061,
                    "ID_GROUPER": 2,
                    "CREDITS": 3
                }, {
                    "NAME": "Microeconomía",
                    "ID": 1062,
                    "ID_GROUPER": 3,
                    "CREDITS": 2
                }, {
                    "NAME": "Pensamiento algorítmico",
                    "ID": 1063,
                    "ID_GROUPER": 3,
                    "CREDITS": 2
                }, {
                    "NAME": "Constitución y democracia",
                    "ID": 1013,
                    "ID_GROUPER": 4,
                    "CREDITS": 2
                }, {
                    "NAME": "Inglés de acceso",
                    "ID": 1021,
                    "ID_GROUPER": 4,
                    "CREDITS": 2
                }]
            }, {
                "ID_SEMESTER": 3,
                "SEMESTER_NAME": "Semestre 3",
                "TOTAL_CREDITS": 15,
                "SUBJECTS": [{
                    "NAME": "Física mecánica",
                    "ID": 1015,
                    "ID_GROUPER": 1,
                    "CREDITS": 3
                }, {
                    "NAME": "Cálculo integral",
                    "ID": 1016,
                    "ID_GROUPER": 1,
                    "CREDITS": 3
                }, {
                    "NAME": "Probabilidad y estadística",
                    "ID": 1029,
                    "ID_GROUPER": 2,
                    "CREDITS": 3
                }, {
                    "NAME": "Macroeconomía",
                    "ID": 1064,
                    "ID_GROUPER": 4,
                    "CREDITS": 2
                }, {
                    "NAME": "Franciscanismo y ecología",
                    "ID": 1020,
                    "ID_GROUPER": 4,
                    "CREDITS": 2
                }, {
                    "NAME": "Inglés de plataforma",
                    "ID": 1027,
                    "ID_GROUPER": 4,
                    "CREDITS": 2
                }]
            }, {
                "ID_SEMESTER": 4,
                "SEMESTER_NAME": "Semestre 4",
                "TOTAL_CREDITS": 15,
                "SUBJECTS": [{
                    "NAME": "Física electromagnética",
                    "ID": 1022,
                    "ID_GROUPER": 1,
                    "CREDITS": 2
                }, {
                    "NAME": "Cálculo multivariado",
                    "ID": 1023,
                    "ID_GROUPER": 1,
                    "CREDITS": 3
                }, {
                    "NAME": "Inferencia estadística",
                    "ID": 1065,
                    "ID_GROUPER": 2,
                    "CREDITS": 3
                }, {
                    "NAME": "Procesos industriales",
                    "ID": 1066,
                    "ID_GROUPER": 2,
                    "CREDITS": 3
                }, {
                    "NAME": "Organizaciones",
                    "ID": 1032,
                    "ID_GROUPER": 3,
                    "CREDITS": 2
                }, {
                    "NAME": "Metodología de la investigación",
                    "ID": 1067,
                    "ID_GROUPER": 4,
                    "CREDITS": 2
                }]
            }, {
                "ID_SEMESTER": 5,
                "SEMESTER_NAME": "Semestre 5",
                "TOTAL_CREDITS": 17,
                "SUBJECTS": [{
                    "NAME": "Ecuaciones diferenciales",
                    "ID": 1028,
                    "ID_GROUPER": 1,
                    "CREDITS": 3
                }, {
                    "NAME": "Investigación de operaciones I",
                    "ID": 1068,
                    "ID_GROUPER": 3,
                    "CREDITS": 3
                }, {
                    "NAME": "Organización y métodos",
                    "ID": 1069,
                    "ID_GROUPER": 3,
                    "CREDITS": 2
                }, {
                    "NAME": "Talento humano",
                    "ID": 1070,
                    "ID_GROUPER": 3,
                    "CREDITS": 2
                }, {
                    "NAME": "Proyecto integrador I",
                    "ID": 1032,
                    "ID_GROUPER": 3,
                    "CREDITS": 3
                }, {
                    "NAME": "Contabilidad general",
                    "ID": 1071,
                    "ID_GROUPER": 4,
                    "CREDITS": 2
                }, {
                    "NAME": "Ética",
                    "ID": 1040,
                    "ID_GROUPER": 4,
                    "CREDITS": 2
                }]
            }, {
                "ID_SEMESTER": 6,
                "SEMESTER_NAME": "Semestre 6",
                "TOTAL_CREDITS": 12,
                "SUBJECTS": [{
                    "NAME": "Ingeniería de productos",
                    "ID": 1072,
                    "ID_GROUPER": 2,
                    "CREDITS": 3
                }, {
                    "NAME": "Investigación de operaciones II",
                    "ID": 1073,
                    "ID_GROUPER": 3,
                    "CREDITS": 3
                }, {
                    "NAME": "Planeación y control de producción",
                    "ID": 1074,
                    "ID_GROUPER": 3,
                    "CREDITS": 2
                }, {
                    "NAME": "Electiva complementaria I",
                    "ID": 1036,
                    "ID_GROUPER": 3,
                    "CREDITS": 2
                }, {
                    "NAME": "Costos y presupuesto",
                    "ID": 1075,
                    "ID_GROUPER": 4,
                    "CREDITS": 2
                }, {
                    "NAME": "Electiva humanística I",
                    "ID": 1047,
                    "ID_GROUPER": 4,
                    "CREDITS": 2
                }]
            }, {
                "ID_SEMESTER": 7,
                "SEMESTER_NAME": "Semestre 7",
                "TOTAL_CREDITS": 14,
                "SUBJECTS": [{
                    "NAME": "Sistemas de información",
                    "ID": 1076,
                    "ID_GROUPER": 2,
                    "CREDITS": 3
                }, {
                    "NAME": "Control estadístico de procesos",
                    "ID": 1077,
                    "ID_GROUPER": 3,
                    "CREDITS": 3
                }, {
                    "NAME": "Localización y diseño de plantas",
                    "ID": 1078,
                    "ID_GROUPER": 3,
                    "CREDITS": 2
                }, {
                    "NAME": "Análisis financiero",
                    "ID": 1079,
                    "ID_GROUPER": 4,
                    "CREDITS": 2
                }, {
                    "NAME": "Electiva complementaria II",
                    "ID": 1045,
                    "ID_GROUPER": 4,
                    "CREDITS": 2
                }, {
                    "NAME": "Electiva humanística II",
                    "ID": 1054,
                    "ID_GROUPER": 3,
                    "CREDITS": 2
                }]
            }, {
                "ID_SEMESTER": 8,
                "SEMESTER_NAME": "Semestre 8",
                "TOTAL_CREDITS": 13,
                "SUBJECTS": [{
                    "NAME": "Mercadeo",
                    "ID": 1080,
                    "ID_GROUPER": 2,
                    "CREDITS": 2
                }, {
                    "NAME": "Modelamiento matemático aplicado",
                    "ID": 1081,
                    "ID_GROUPER": 2,
                    "CREDITS": 2
                }, {
                    "NAME": "Logística",
                    "ID": 1082,
                    "ID_GROUPER": 3,
                    "CREDITS": 2
                }, {
                    "NAME": "Gerencia de producción",
                    "ID": 1083,
                    "ID_GROUPER": 3,
                    "CREDITS": 3
                }, {
                    "NAME": "Formulación evaluación y control de proyectos",
                    "ID": 1084,
                    "ID_GROUPER": 4,
                    "CREDITS": 3
                }]
            }, {
                "ID_SEMESTER": 9,
                "SEMESTER_NAME": "Semestre 9",
                "TOTAL_CREDITS": 11,
                "SUBJECTS": [{
                    "NAME": "Electiva de profundización",
                    "ID": 1055,
                    "ID_GROUPER": 3,
                    "CREDITS": 2
                }, {
                    "NAME": "Trabajo de grado",
                    "ID": 1051,
                    "ID_GROUPER": 3,
                    "CREDITS": 4
                }, {
                    "NAME": "Electiva complementaria III",
                    "ID": 1085,
                    "ID_GROUPER": 3,
                    "CREDITS": 2
                }, {
                    "NAME": "Práctica profesional",
                    "ID": 1056,
                    "ID_GROUPER": 4,
                    "CREDITS": 3
                }]
            }, {
                "ID_SEMESTER": 10,
                "SEMESTER_NAME": "Semestre 10",
                "TOTAL_CREDITS": 13,
                "SUBJECTS": [{
                    "NAME": "Electiva de profundización",
                    "ID": 1055,
                    "ID_GROUPER": 3,
                    "CREDITS": 3
                }, {
                    "NAME": "Electiva complementaria IV",
                    "ID": 1086,
                    "ID_GROUPER": 3,
                    "CREDITS": 3
                }, {
                    "NAME": "Electiva complementaria V",
                    "ID": 1087,
                    "ID_GROUPER": 3,
                    "CREDITS": 3
                }, {
                    "NAME": "Cátedra emprendimiento",
                    "ID": 1050,
                    "ID_GROUPER": 4,
                    "CREDITS": 2
                }, {
                    "NAME": "Electiva humanística III",
                    "ID": 1059,
                    "ID_GROUPER": 4,
                    "CREDITS": 2
                }]
            }]
}]';*/
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
