import { Component, OnInit, Input, EventEmitter, Output } from '@angular/core';

@Component({
  selector: 'app-view-content',
  templateUrl: './view-content.component.html',
  styleUrls: ['./view-content.component.scss']
})
export class ViewContentComponent implements OnInit {

  @Input()
  content: string;

  @Output()
  changeContent: EventEmitter<any> = new EventEmitter();

  constructor() { }

  ngOnInit() {
  }

  getContent(content){
    this.changeContent.emit(content);
  }
}
