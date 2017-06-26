import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-titlebar',
  templateUrl: './titlebar.component.html',
  styleUrls: ['./titlebar.component.css']
})
export class TitlebarComponent implements OnInit {

  constructor() { }

  // Título de la vista
  @Input()
  sbTitle: string;
  dtHour:any;
  
  ngOnInit() {
    /*var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = this.checkTime(m);
    s = this.checkTime(s);
    this.dtHour= h + ":" + m + ":" + s;
    var t = setTimeout(this.ngOnInit, 500);*/
    this.CalcTime();
  }

  CalcTime(){
    let me = this,
    today = new Date(),
    nuHour = today.getHours(),
    nuMinutes = today.getMinutes(),
    nuSeconds = today.getSeconds(),
    sbTime = "a.m";

    nuMinutes = me.checkTime(nuMinutes);

    if(nuHour>12){
      nuHour = nuHour-12;
      sbTime= "p.m";
    }
    me.dtHour= nuHour + ":" + nuMinutes +" "+sbTime+"    "+ me.FormatDate(today);
    let t = setTimeout(me.CalcTime, 500);
  }

 
checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
FormatDate(date) {
  var arMonthNames = [
    "Ene", "Feb", "Mar",
    "Apr", "May", "Jun", "Jul",
    "Ago", "Sep", "Oct",
    "Nov", "Dic"
  ];

  var dtDay = date.getDate();
  var dtMonthIndex = date.getMonth();
  var dtYear = date.getFullYear();
  var dtMonth = arMonthNames[dtMonthIndex];

  return dtDay + '/' + dtMonth + '/' + dtYear;
}

}
