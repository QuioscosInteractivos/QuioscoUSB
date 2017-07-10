import { Component, OnInit, EventEmitter, Output } from '@angular/core';
import { Utilities } from "app/utilities";
import { HomeService } from "app/services/home.service";

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {

  constructor(private HomeService:HomeService, private Utilities: Utilities) { }

  // Mensajes
	sbErrorMessage: String = '';
	sbMaskMessage: String = '';
  // Inicio
  sbTitle: String = '';
  sbSubtitle: String = '';
  sbWelcome: String = '';

  @Output()
  changeContent: EventEmitter<any> = new EventEmitter();
  
  ngOnInit() {

		// Adicionando mascara
		this.sbMaskMessage = 'Consultando información';

		// Se llama al método del servicio, recibe como entrada lo mismo con lo que resolvió la promesa
		this.HomeService.getWelcome().then(
			iarData=>{
				this.sbTitle = iarData.TITLE;
        this.sbSubtitle = iarData.SUBTITLE;
        this.sbWelcome = iarData.WELCOME;

				// Removiendo mascara
				this.sbMaskMessage = '';
			}
		).catch(iobError => {
			// Removiendo mascara
			this.sbMaskMessage = '';
			this.sbErrorMessage = iobError;
			console.log(iobError)
		});
	}

  ChangeView(){
    this.changeContent.emit('News');
  }

  CloseErrorMsg() {
		this.sbErrorMessage = '';
	}
}
