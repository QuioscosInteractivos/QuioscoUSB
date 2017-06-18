import { Component, OnInit } from '@angular/core';
import { FindCourseService } from "app/services/find-course.service";
import { Utilities } from "app/utilities";

@Component({
  selector: 'app-course-finder',
  templateUrl: './course-finder.component.html',
  styleUrls: ['./course-finder.component.css']
})
export class CourseFinderComponent implements OnInit {

  constructor(private FindCourseService: FindCourseService, private Utilities: Utilities) {}

    // Título de la vista
    sbTitle: String = 'Ubica tu clase';
		sbSearchPaceholder: String = 'Buscar cursos';
    // Parámetro de búsqueda
    sbSearchString: String = '';
    // Receptor de peticiones
    iobData: any = [];
    arBreadCrumb: any = [];
		// Unidades (menú)
		arAllUnits: any = [];
		// Unidades (menú)
    arMenuOptions: any = [];
		// Dependencias de la unidad seleccionada
		arBuildingSchedule: any = [];
		// Propiedad con la que se ordena la tabla
		sbOrderProperty: any = 'DESCRIPTION';
		// Flag que determina si el orden es ascendente o descendente
		blReverseOrder: any = false;
		arCourseSchedule: any = [];

  ngOnInit() {
    this.FindCourseService.getBuildings().then(
      arbData => {
          
					this.Utilities.ReplaceArrayItems(this.arAllUnits, arbData);
					// Primer crumb					
          this.ShowSons(this.getBaseCrumb());
        }
      ).catch(
        sbError => {console.log(sbError)}
      );
  }
		
		getBaseCrumb() {
			return {
							ID: null,
							DESCRIPTION: 'Edificios',
							SONS: this.arAllUnits
						};
		}	

		// Muestra las opciones hijas de una selección en el menú.
		ShowSons(iobCrumb) {
			let me = this,
			    nuId = iobCrumb.ID,
				  nuLastCrumb = 0;

			if(nuId === 'CANCEL_SEARCH'){
				me.Utilities.ReplaceArrayItems(me.arBreadCrumb, null);
				iobCrumb = me.getBaseCrumb();
				// Limpiando el buscador
				this.sbSearchString = '';
			}

			// Guardando el registro anterior en la miga de pan.
			this.arBreadCrumb.push(iobCrumb);
			
				// Limpiando las vistas de horarios
				me.Utilities.ReplaceArrayItems(me.arCourseSchedule, null);
				me.Utilities.ReplaceArrayItems(me.arBuildingSchedule, null);
				// Se limpian las opciones del menú
				me.Utilities.ReplaceArrayItems(me.arMenuOptions, null);

			// Si llega con info del docente entonces es horario de una materia
			if(iobCrumb.TEACHER){
					// Cuando se llega al horario de una clase
					me.Utilities.ReplaceArrayItems(me.arCourseSchedule, iobCrumb.SCHEDULES);

			} else if(iobCrumb.SCHEDULE){
				// Cuando llega a la programación de auditorios de un edificio
					me.Utilities.ReplaceArrayItems(me.arBuildingSchedule, iobCrumb.SCHEDULE);

			} else if(iobCrumb.SONS){
				// Cuando llega a la programación de auditorios de un edificio
					me.Utilities.ReplaceArrayItems(me.arMenuOptions, iobCrumb.SONS);

			} else {
					// Cuando no hay mas hijos en el menú
					nuId = Number(iobCrumb.ID);

          console.log(nuId);
					if (isNaN(nuId)) {
						console.log('No es un ID válido');
						return;
					}

          // Pedir los auditorios de un edificio (Vienen con su programación)
          this.FindCourseService.getAuditoriums(nuId).then(
              iarData => {
                // Guardando la información consultada en la selección
                iobCrumb.SCHEDULE = iarData;
								me.Utilities.ReplaceArrayItems(this.arBuildingSchedule, iarData);
								console.log(iarData);
            }
          ).catch(
            sbError => console.log(sbError)
          );
			}
		}

		// inuIndex es el número de la iteración por la que va un elemento,
		//		no el indice real en el arreglo en el que esta (en otras palabras
		//		no va a conconrdar con la posición real si el arreglo ha sido filtrado).
		GoTo(inuIndex, iobCrumb){
			let me = this,
				  obCrumb = null;

			// Borrando los crumbs que estan después del seleccionado
			this.arBreadCrumb.splice(inuIndex+1);
			obCrumb = this.arBreadCrumb.pop();

			// Pide continuar con la lógica usual al seleccionar algo del menú
			this.ShowSons(obCrumb);
		}

    Search(){
      console.log(this.sbSearchString);

      this.FindCourseService.getCoursesSearch(this.sbSearchString).then(
        iobData => {
          // limpiando los breadcrumbs
          this.Utilities.ReplaceArrayItems(this.arBreadCrumb, [{
            ID: 'CANCEL_SEARCH',
            DESCRIPTION: '   X   '
          }]);

          // Definiendo el nuevo inicio
          this.ShowSons({
            ID: null,
            DESCRIPTION: 'Resultados para "' + this.sbSearchString + '"',
            SONS: iobData
          });
        }
      ).catch(iobError => console.log(iobError))
    }

		// Define las variables usadas para ordenar la tabla que contiene la información de dependencias.
		/*OrderBy = function(isbProperty, iblReverse){
			var me = this;

			if (typeof(iblReverse) === 'boolean') {
				// Toma ambos datos
				this.sbOrderProperty = isbProperty;
				this.blReverseOrder = iblReverse;

			} else {
				// Valida la propiedad actual para decidir el orden
				if (this.sbOrderProperty === isbProperty) {
					this.blReverseOrder = !this.blReverseOrder;

				} else {
					// Por defecto es de menor a mayor
					this.sbOrderProperty = isbProperty;
					this.blReverseOrder = false;
				}
			}
    }*/
}
