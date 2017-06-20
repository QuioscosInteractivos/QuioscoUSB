import { Component, OnInit } from '@angular/core';
import { Utilities } from "app/utilities";

@Component({
  selector: 'app-map',
  templateUrl: './map.component.html',
  styleUrls: ['./map.component.css']
})
export class MapComponent implements OnInit {

  constructor(private Utilities: Utilities) { }

  // Título de la vista
  sbTitle: any = 'Mapa de la universidad';
  arMapItems: any = [];
  obSelected: any = null;

  ngOnInit() {
    let arDatos = [{
      NUMBER: 1,
      DESCRIPTION: 'Número 2',
      IMG: '14.svg'
    }, {
      NUMBER: 2,
      DESCRIPTION: 'Número 1',
      IMG: '1.svg'
    }];

    this.Utilities.ReplaceArrayItems(this.arMapItems, arDatos);
  }

  Select(iobItem){
    this.obSelected = iobItem;
  }

}
