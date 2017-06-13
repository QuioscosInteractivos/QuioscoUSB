import { Injectable } from '@angular/core';
import { Http } from "@angular/http/";

@Injectable()
export class PlanesDeEstudioService {

  constructor(private Http: Http) { }

  sbBaseURL: String = "http://localhost/QuioscoUSB/services/";

  getFaculties(){
    let sbUrl = "Index/faculties";

    // Petición
    return this.SendRequest(sbUrl);
  }

  getCarrers(inuId){
    let sbUrl = "Index/carrers?inuId="+inuId;

    return this.SendRequest(sbUrl);
  }

  SendRequest(isbUrl){
    let sbUrl = this.sbBaseURL+isbUrl;

    // Petición
    return this.Http.get(sbUrl).toPromise()
        .then(iobData => iobData.json());
  }
}
