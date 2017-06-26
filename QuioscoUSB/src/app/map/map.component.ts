import { Component, OnInit } from '@angular/core';
import { Utilities } from "app/utilities";
import { MapService } from "app/services/map.service";

@Component({
  selector: 'app-map',
  templateUrl: './map.component.html',
  styleUrls: ['./map.component.css']
})
export class MapComponent implements OnInit {

  constructor(private MapService: MapService, private Utilities: Utilities) { }

  // Título de la vista
  sbTitle: any = 'Mapa de la universidad';
  arMapItems: any = [];
  obSelected: any = null;
  sbMaskMessage: String = '';
  sbErrorMessage: String = '';
  sbMap: String;
  sbBaseLayer: String;
  sbLocation: String;
  sbSearchPaceholder: String = 'Buscar lugar';
  sbSearchString: String = '';
  sbSearchRestriction: String = '';
  arBreadCrumb: Array<Object> = [];

  ngOnInit() {

    // Adicionando mascara
		this.sbMaskMessage = 'Consultando ítems del mapa';

    // Se llama al método del servicio, recibe como entrada lo mismo con lo que resolvió la promesa
    this.MapService.getMapData().then(
      iarData => {
        this.sbMap = iarData.MAP;
        this.sbBaseLayer = iarData.BASE_LAYER;
        this.sbLocation = iarData.LOCATION;

        this.Utilities.ReplaceArrayItems(this.arMapItems, iarData.LAYERS);
        this.arMapItems.sort(this.DataSorter.bind(this));

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

  Select(iobItem){
    this.obSelected = iobItem;
  }

  CloseErrorMsg() {
			this.sbErrorMessage = '';
	}

  // Función pasada a un arreglo de datos para que lo organice.
		// Toma las configuraciones para el filtrado de esta clase.
		DataSorter(iobData01, iobData02) {

			if (Number(iobData01.NUMBER) < Number(iobData02.NUMBER))
				return -1;
			if (Number(iobData01.NUMBER) > Number(iobData02.NUMBER))
				return 1;

			return 0;
		}

    ShowSons(iobSelection){
      if(iobSelection.ID === 'CANCEL_SEARCH'){
        // Quita el breadcrumb
        this.Utilities.ReplaceArrayItems(this.arBreadCrumb, null);
        // Limpiando el buscador
        this.sbSearchString = '';
      }
    }

    Search(){
      let sbSearch = this.sbSearchString.trim();

      if(sbSearch.length < 4 ){
        this.sbSearchRestriction = '* Por favor ingrese mas de 4 caracteres.';
        return;

      } else {
        this.sbSearchRestriction = '';
      }

      // Añadiendo mascara
      this.sbMaskMessage = 'Consultando carreras';

      this.MapService.getMapSearch(sbSearch).then(
        iobData => {
        // Dejando solo un crumb para cancelar la búsqueda
        this.Utilities.ReplaceArrayItems(this.arBreadCrumb, [{
          ID: 'CANCEL_SEARCH',
          NAME: '   X   '
        }]);

        // Definiendo el nuevo inicio
        this.ShowSons({
          ID: 'SEARCH_RESULT',
          NAME: 'Resultados para "' + this.sbSearchString + '"',
          SONS: iobData
        });

        // Removiendo mascara
        this.sbMaskMessage = '';

      }).catch(iobError => {
        // Removiendo mascara
        this.sbMaskMessage = '';
        this.sbErrorMessage = iobError;
      });
    }
}
