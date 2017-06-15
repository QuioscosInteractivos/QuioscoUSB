import { Injectable } from '@angular/core';
import { ServicesUtilities } from "app/services/services-utilities";

@Injectable()
export class FindCourseService {

  constructor(private ServicesUtilities: ServicesUtilities) {}

  getBuildings(){
    let sbUrl = "Index/buildings";

    // Petición
    return this.ServicesUtilities.SendRequest(sbUrl);
  }

// Consultar la programación de un auditorio
  getAuditoriums(inuId){
    let sbUrl = "Index/auditoriums?inuId="+inuId;

    return this.ServicesUtilities.SendRequest(sbUrl);
  }

  getCourses(isbSearhString){
    let sbUrl = "Index/courses?isbSearhString="+isbSearhString;

    return this.ServicesUtilities.SendRequest(sbUrl);
  }

   getBy(isbField, iobValue){
    let sbUrl = "Index/auditorios/"+iobValue;

    // Petición
    return this.ServicesUtilities.SendRequest(sbUrl);
  }
}