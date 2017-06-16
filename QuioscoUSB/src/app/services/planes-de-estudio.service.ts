import { Injectable } from '@angular/core';
import { ServicesUtilities } from "app/services/services-utilities";

@Injectable()
export class PlanesDeEstudioService {

  constructor(private ServicesUtilities: ServicesUtilities) { }

  getFaculties(){
    let sbUrl = "Index/faculties";

    // Petición
    return this.ServicesUtilities.SendRequest(sbUrl);
  }

  getCarrers(inuId){
    let sbUrl = "Index/carrers?inuId="+inuId;

    return this.ServicesUtilities.SendRequest(sbUrl);
  }

  getCarrersSearch(inuId){
    let sbUrl = "Index/carrersSearch?inuId="+inuId;

    return this.ServicesUtilities.SendRequest(sbUrl);
  }
}
