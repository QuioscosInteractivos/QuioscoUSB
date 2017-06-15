import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-news',
  templateUrl: './news.component.html',
  styleUrls: ['./news.component.scss']
})
export class NewsComponent implements OnInit {

  constructor() { }

  @Input()
  content: string;

  @Output()
  changeContent: EventEmitter<any> = new EventEmitter();

  changeView(sbView: String){
    this.changeContent.emit(sbView);
  }
  
  ngOnInit() {
  }

}
