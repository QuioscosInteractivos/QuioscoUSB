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
    this.initInterval();
  }

  initInterval(){
    this.timer = setInterval(
      ()=>{
        this.getContent('News');
        console.log(this.content);
      }, 50000);
  }

  getContent(content){
    this.content = content;
  }

  gnt(){
    console.log('sdfsfsfs');
    console.log(this.timer);

    if(this.timer){
      clearInterval(this.timer);
      this.initInterval();
    }
  }

}
