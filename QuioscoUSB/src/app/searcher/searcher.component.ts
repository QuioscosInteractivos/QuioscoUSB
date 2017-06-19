import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-searcher',
  templateUrl: './searcher.component.html',
  styleUrls: ['./searcher.component.css']
})
export class SearcherComponent implements OnInit {

  constructor() { }

  @Input()
  sbSearchPaceholder: String;
  @Input()
	sbSearchHint: String = '';
  // Función que hace la petición
  @Input()
  obService: any;

  @Output()
  arSearchResults: EventEmitter<any> = new EventEmitter();

  // Parámetro de búsqueda
  sbSearchString: String = '';
  sbMaskMessage: String = '';
  sbErrorMessage: String = '';

  ngOnInit() {
  }

  Search(){
		console.log(this.sbSearchString);

		let sbSearch = this.sbSearchString.trim();

    this.sbErrorMessage = '';

		if(sbSearch.length < 4 ){
			console.log('Por favor ingrese mas información.');
      this.sbErrorMessage = 'Por favor ingrese mas información.';

		} else {
			// Removiendo mascara
			this.sbMaskMessage = 'Consultando planes de estudio';

			this.obService(this.sbSearchString).then(
				iobData => {
          console.log(iobData);
          this.arSearchResults.emit({
            searchString: this.sbSearchString,
            results: iobData});
				//if(iobData.length > 0) {
					// Dejando solo un crumb para cancelar la búsqueda
					/*this.Utilities.ReplaceArrayItems(this.arBreadCrumb, [{
						ID: 'CANCEL_SEARCH',
						NAME: '   X   '
					}]);

					// Definiendo el nuevo inicio
					this.ShowSons({
						ID: 'SEARCH_RESULT',
						NAME: 'Resultados para "' + this.sbSearchString + '"',
						SONS: iobData
					});
				//}*/
				
				// Removiendo mascara
				this.sbMaskMessage = '';
			}
			).catch(iobError => {
				// Removiendo mascara
				this.sbMaskMessage = '';
				this.sbErrorMessage = iobError;
				console.log(iobError);
			})
		}
	}
}
