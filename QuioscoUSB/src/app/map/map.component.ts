import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-map',
  templateUrl: './map.component.html',
  styleUrls: ['./map.component.css']
})
export class MapComponent implements OnInit {

  constructor() { }

  // Título de la vista
  sbTitle: any = 'Mapa de la universidad';

  ngOnInit() {
  }

}
