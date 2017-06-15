import { Component, OnInit } from '@angular/core';
import { DirectoryService } from "app/services/directory.service";

@Component({
  selector: 'app-directory',
  templateUrl: './directory.component.html',
  styleUrls: ['./directory.component.css']
})
export class DirectoryComponent implements OnInit {

  constructor(private DirectoryService: DirectoryService) { }

		// Título de la vista
    sbTitle: any = 'Directorio institucional';
    // Parámetro de búsqueda
    sbSearchString: String = '';
		// Elementos de la miga de pan
		arBreadCrumb = [];
		// Unidades (menú)
		arAllUnits = [];
		// Unidades (menú)
		arUnits = [];
		// Dependencias de la unidad seleccionada
		arDependencies = [];
		// Propiedad con la que se ordena la tabla
		sbOrderProperty = 'DESCRIPTION';
		// Flag que determina si el orden es ascendente o descendente
		blReverseOrder = false;
    

  ngOnInit() {
    // Se llama al método del servicio, recibe como entrada lo mismo con lo que resolvió la promesa
    this.DirectoryService.getUnits().then(
      iarData => {
        this.arUnits = iarData;
        this.arAllUnits = iarData;
          // Primer crumb
          this.ShowSons({
            ID: null,
            DESCRIPTION: 'Edificios',
            SONS: iarData
          });
        }
      ).catch(
        sbError => {console.log(sbError)}
      );
  }

		
		
		// Muestra las opciones hijas de una selección en el menú.
		ShowSons(iobUnit){
      let me = this,
			    nuId = iobUnit.ID,
				  nuLastCrumb = 0;

			// Guardando el registro anterior en la miga de pan.
			me.arBreadCrumb.push(iobUnit);
			// Reinicia las propiedades usadas para ordenar
			me.OrderBy('DESCRIPTION', false);

			if(iobUnit.DEPENDENCIES){
				// Cuando se llega a las dependencias de una unidad
				me.arDependencies = iobUnit.DEPENDENCIES;
				// Se limpian las opciones del menú
				me.arUnits.length=0;

			} else {
				// Limpiando la vista de pensum
				me.arDependencies.length=0;

				if (!iobUnit.SONS || (iobUnit.SONS.length === 0)) {
					// Cuando no hay mas hijos en el menú
					nuId = Number(iobUnit.ID);

					if (isNaN(nuId)) {
						console.log('No es un ID válido');
						return;
					}

          me.DirectoryService.getDependencies(nuId).then(
            iarData => {
              // Agrega las dependencias de la unidad seleccionada
              me.arDependencies = iarData;
              // Se limpian las opciones del menú
              me.arUnits.length=0;
                
                nuLastCrumb = (me.arBreadCrumb.length - 1);
						    me.arBreadCrumb[nuLastCrumb].DEPENDENCIES = iarData;
              }
            ).catch(
              sbError => {console.log(sbError)}
            );
				} else {
					// Cambia las opciones a desplegar
					me.arUnits = iobUnit.SONS;
				}
			}

		}

		// inuIndex es el número de la iteración por la que va un elemento,
		//		no el indice real en el arreglo en el que esta (en otras palabras
		//		no va a conconrdar con la posición real si el arreglo ha sido filtrado).
		GoTo(inuIndex, iobCrumb){
			var me = this,
				obCrumb = null;

			// Borrando los crumbs que estan después del seleccionado
			me.arBreadCrumb.splice(inuIndex+1);
			obCrumb = me.arBreadCrumb.pop();

			// Pide continuar con la lógica usual al seleccionar algo del menú
			me.ShowSons(obCrumb);
		}

		// Define las variables usadas para ordenar la tabla que contiene la información de dependencias.
		OrderBy(isbProperty, iblReverse){
      // *** Tiene que re hacerse!!!! ***
			let me = this;

			if (typeof(iblReverse) === 'boolean') {
				// Toma ambos datos
				me.sbOrderProperty = isbProperty;
				me.blReverseOrder = iblReverse;

			} else {
				// Valida la propiedad actual para decidir el orden
				if (me.sbOrderProperty === isbProperty) {
					me.blReverseOrder = !me.blReverseOrder;

				} else {
					// Por defecto es de menor a mayor
					me.sbOrderProperty = isbProperty;
					me.blReverseOrder = false;
				}
			}
		}

    Search(){
      console.log(this.sbSearchString);

      this.DirectoryService.getDependenciesSearch(this.sbSearchString).then(
        iobData => {
          // limpiando los breadcrumbs
          this.arBreadCrumb.length = 0;

          // Definiendo el nuevo inicio
          this.ShowSons({
            ID: null,
            DESCRIPTION: 'Resultados para "' + this.sbSearchString + '"' + 'Da errores al hacer click sobre uno!!!!',
            SONS: iobData
          });
        }
      ).catch(iobError => console.log(iobError))
    }
}
