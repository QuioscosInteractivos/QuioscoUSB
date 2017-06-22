import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit {
  content: string;

  timer: any;

  ngOnInit() {
    this.getContent('News');
    this.initInterval();
  }

  initInterval(){
    this.timer = setInterval(
      ()=>{
        this.getContent('News');
      }, 150000); // < 3 minútos
  }

  getContent(content){
    this.content = content;
  }

  gnt(){
    if(this.timer){
      clearInterval(this.timer);
      this.initInterval();
    }
  }

}
