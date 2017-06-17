import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-sidebar',
  templateUrl: './sidebar.component.html',
  styleUrls: ['./sidebar.component.scss']
})
export class SidebarComponent implements OnInit {

  blPensumSelected: Boolean = false;
  blCourseFinder: Boolean = false;
  blDirectory: Boolean = false;
  blMap: Boolean = false;

  @Input()
  content: string;

  @Output()
  changeContent: EventEmitter<any> = new EventEmitter();
  
  constructor() { }

  emitChange(component: String){

      this.blPensumSelected = (component === 'Pensum')? true : false;
      this.blCourseFinder = (component === 'CourseFinder')? true : false;
      this.blDirectory = (component === 'Directory')? true : false;
      this.blMap = (component === 'Map')? true : false;

    this.changeContent.emit(component);
  }

  ngOnInit() {
  }

}
