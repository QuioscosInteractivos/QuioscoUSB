import { Component, OnInit } from '@angular/core';
import { PlanesDeEstudioService } from "app/services/planes-de-estudio.service";
import { Utilities } from "app/utilities";

@Component({
  selector: 'app-planes-de-estudio',
  templateUrl: './planes-de-estudio.component.html',
  styleUrls: ['./planes-de-estudio.component.scss']
})
export class PlanesDeEstudioComponent implements OnInit {

  constructor(private PlanesDeEstudioService: PlanesDeEstudioService, private Utilities: Utilities) { }

  // Inicializando
  // Título de la vista
    sbTitle: any = 'Planes de estudio';
	// Elementos de la miga de pan
	arBreadCrumb = [];
	// Elementos a mostrar en el menú
	arMenuFaculties = [];
	// Todos los elementos consultados
	arAllfaculties = [];
	// Pensum de una carrera seleccionada
	arPensum = [];
	// Colores de las clases
	arCourseTypeClasses = ['blue', 'yellow', 'green', 'red'];
	obCourseClasses = {};

  ngOnInit() {
    // Primer crumb
		this.arBreadCrumb.push({
			ID: null,
			NAME: 'Facultades',
			SONS: this.arAllfaculties
		});

		// Se llama al método del servicio, recibe como entrada lo mismo con lo que resolvió la promesa
		this.PlanesDeEstudioService.getFaculties().then(
      iarData=>{
		  console.log(iarData);
        this.arAllfaculties = iarData;
        this.arMenuFaculties = iarData;
      }
    ).catch(iobError => console.log(iobError));
  }
		
		ShowSons = function(iobfaculty){
			let me = this,
				  nuLastCrumb = 0;

			if(iobfaculty.SEMESTERS){
				me.arBreadCrumb.push(iobfaculty);
				// Cuando se llega al pensum de una carrera
				this.Utilities.ReplaceArrayItems(me.arPensum = [iobfaculty]);
				// Se limpian las opciones del menú
				this.Utilities.ReplaceArrayItems(me.arMenuFaculties);

			} else {
				// Guardando el registro anterior en la miga de pan.
				me.arBreadCrumb.push(iobfaculty);
				// Limpiando la vista de pensum
				this.Utilities.ReplaceArrayItems(me.arPensum);

				if (!iobfaculty.SONS || (iobfaculty.SONS.length === 0)) {
					// Cuando no hay mas hijos en el menú
					let nuId = Number(iobfaculty.ID);

					if (isNaN(nuId)) {
						console.log('No es un ID válido');
						return;
					}

					this.PlanesDeEstudioService.getCarrers(nuId).then(
						iobData=>{
						nuLastCrumb = (me.arBreadCrumb.length - 1);
						me.arBreadCrumb[nuLastCrumb].SONS = iobData;
						// Cambiando las opciones a desplegar
						this.Utilities.ReplaceArrayItems(me.arMenuFaculties, iobData);
						}
					).catch(iobError=>console.log(iobError));

			} else {
				// Cambia las opciones a desplegar
				this.Utilities.ReplaceArrayItems(me.arMenuFaculties, iobfaculty.SONS);
			}
		}
	}

		// inuIndex es el número de la iteración por la que va un elemento,
		//		no el indice real en el arreglo en el que esta (en otras palabras
		//		no va a conconrdar con la posición real si el arreglo ha sido filtrado).
		GoTo = function(inuIndex, iobCrumb){
			let me = this,
				  obCrumb = null;

			// Borrando los crumbs que estan después del seleccionado
			me.arBreadCrumb.splice(inuIndex+1);
			obCrumb = me.arBreadCrumb.pop();

			// Pide continuar con la lógica usual al seleccionar algo del menú
			me.ShowSons(obCrumb);
		}

		// Devuelve la clase correspondiente a un tipo de curso.
		getCourseTypeColor = function(inuID){
			let me = this;

			if(!me.obCourseClasses[inuID]) {
				me.obCourseClasses[inuID] = me.arCourseTypeClasses.shift();
			}

			return me.obCourseClasses[inuID];
		}

		// Devuelve la suma de todos los créditos en un semestre.
		getTotalCredits = function(iobSemester) {
			var me = this,
				nuTotal = 0;

			for (var i = iobSemester.SUBJECTS.length - 1; i >= 0; i--) {
				nuTotal += iobSemester.SUBJECTS[i].CREDITS;
			}

			return nuTotal;
		}
}
