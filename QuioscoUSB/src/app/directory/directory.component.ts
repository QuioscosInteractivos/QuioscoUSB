import { Component, OnInit } from '@angular/core';
import { DirectoryService } from "app/services/directory.service";
import { Utilities } from "app/utilities";

@Component({
  selector: 'app-directory',
  templateUrl: './directory.component.html',
  styleUrls: ['./directory.component.css']
})
export class DirectoryComponent implements OnInit {

  constructor(private DirectoryService: DirectoryService, private Utilities: Utilities) { }

		// Título de la vista
    sbTitle: String = 'Directorio institucional';
		// Buscador
		sbSearchPaceholder: String = 'Buscar dependencia';
		sbSearchHint: String = '';
		sbSearchRestriction: string = '';
		// Mensajes
		sbErrorMessage: String = '';
		sbMaskMessage: String = '';
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

		// Adicionando mascara
		this.sbMaskMessage = 'Consultando unidades';

    // Se llama al método del servicio, recibe como entrada lo mismo con lo que resolvió la promesa
    this.DirectoryService.getUnits().then(
      iarData => {
        this.Utilities.ReplaceArrayItems(this.arUnits, iarData);
        this.Utilities.ReplaceArrayItems(this.arAllUnits, iarData);
          // Primer crumb
          this.ShowSons(this.getBaseCrumb());

					// Removiendo mascara
					this.sbMaskMessage = '';
        }
      ).catch(isbError => {
				// Removiendo mascara
				this.sbMaskMessage = '';
				this.sbErrorMessage = isbError;
				console.log(isbError);
			});
  }

	getBaseCrumb() {
		return {
            ID: null,
            DESCRIPTION: 'Unidades',
            SONS: this.arAllUnits
          };
	}	
		
		// Muestra las opciones hijas de una selección en el menú.
		ShowSons(iobUnit){
      let me = this,
			    nuId = iobUnit.ID,
				  nuLastCrumb = 0;

			if(iobUnit.ID === 'CANCEL_SEARCH'){
				me.Utilities.ReplaceArrayItems(me.arBreadCrumb, null);
				iobUnit = me.getBaseCrumb();
				// Limpiando el buscador
				this.sbSearchString = '';
			}

			// Guardando el registro anterior en la miga de pan.
			me.arBreadCrumb.push(iobUnit);
			// Reinicia las propiedades usadas para ordenar
			me.OrderBy('DESCRIPTION', false);

			if(iobUnit.DEPENDENCIES){
				// Cuando se llega a las dependencias de una unidad
				me.Utilities.ReplaceArrayItems(me.arDependencies, iobUnit.DEPENDENCIES);
				// Reinicia las propiedades usadas para ordenar
				me.OrderBy('DESCRIPTION', false);
				// Se limpian las opciones del menú
				me.Utilities.ReplaceArrayItems(me.arUnits, null);

			} else {
				// Limpiando la vista de pensum
				me.Utilities.ReplaceArrayItems(me.arDependencies, null);

				if (!iobUnit.SONS) {
					// Cuando no hay mas hijos en el menú
					nuId = Number(iobUnit.ID);

					if (isNaN(nuId)) {
						console.log('No es un ID válido');
						return;
					}

					// Adicionando mascara
					this.sbMaskMessage = 'Consultando dependencias';

          me.DirectoryService.getDependencies(nuId).then(
            iarData => {
              // Agrega las dependencias de la unidad seleccionada
              me.Utilities.ReplaceArrayItems(me.arDependencies, iarData);
							// Reinicia las propiedades usadas para ordenar
							me.OrderBy('DESCRIPTION', false);
              // Se limpian las opciones del menú
              me.Utilities.ReplaceArrayItems(me.arUnits, null);
                
                nuLastCrumb = (me.arBreadCrumb.length - 1);
						    me.arBreadCrumb[nuLastCrumb].DEPENDENCIES = iarData;

								// Removiendo mascara
								this.sbMaskMessage = '';
              }
            ).catch(isbError => {
							// Removiendo mascara
							this.sbMaskMessage = '';
							this.sbErrorMessage = isbError;
							console.log(isbError);
						});
				} else {
					// Cambia las opciones a desplegar
					me.Utilities.ReplaceArrayItems(me.arUnits, iobUnit.SONS);
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

			me.arDependencies.sort(me.DataSorter.bind(me));
		}

		// Función pasada a un arreglo de datos para que lo organice.
		// Toma las configuraciones para el filtrado de esta clase.
		DataSorter(iobData01, iobData02) {
			let me = this,
					// Modificador usado para ordenar en un sentido o en otro.
					nuReverseModifier = me.blReverseOrder ? -1 : 1;

			if (iobData01[me.sbOrderProperty] < iobData02[me.sbOrderProperty])
				return -nuReverseModifier;
			if (iobData01[me.sbOrderProperty] > iobData02[me.sbOrderProperty])
				return nuReverseModifier;
			return 0;
		}

    Search(){
      console.log(this.sbSearchString);

			let sbSearch = this.sbSearchString.trim();

			if(sbSearch.length < 4 ){
				this.sbSearchRestriction = '* Por favor ingrese mas de 4 caracteres.';
				return;

			} else {
				this.sbSearchRestriction = '';
			}

			// Adicionando mascara
			this.sbMaskMessage = 'Consultando dependencias';

      this.DirectoryService.getDependenciesSearch(sbSearch).then(
        iobData => {
          // Dejando solo un crumb para cancelar la búsqueda
          this.Utilities.ReplaceArrayItems(this.arBreadCrumb, [{
            ID: 'CANCEL_SEARCH',
            DESCRIPTION: '   X   '
          }]);

          // Definiendo el nuevo inicio
          this.ShowSons({
            ID: 'SEARCH_RESULT',
            DESCRIPTION: 'Resultados para "' + this.sbSearchString + '"',
            DEPENDENCIES: iobData
          });

					// Removiendo mascara
					this.sbMaskMessage = '';
        }
      ).catch(iobError => {
				// Removiendo mascara
				this.sbMaskMessage = '';
				this.sbErrorMessage = iobError;
				console.log(iobError);
		});
    }

		CloseErrorMsg() {
			this.sbErrorMessage = '';
	}
}
