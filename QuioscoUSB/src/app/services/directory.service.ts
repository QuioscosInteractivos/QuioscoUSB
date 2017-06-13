import { Injectable } from '@angular/core';
import { Http } from "@angular/http/";
import 'rxjs/add/operator/toPromise';

@Injectable()
export class DirectoryService {

  constructor(private Http: Http) {}

  sbBaseURL: String = "http://localhost/QuioscoUSB/services/";

  getUnits(){
    console.log('getUnits');
    let sbUrl = "Index/units";

    // Petición
    return this.SendRequest(sbUrl);
  }

  getDependencies(inuId){
    console.log('getDependencies ID: '+inuId);
    let sbUrl = "Index/dependencies?inuId="+inuId;

    return this.SendRequest(sbUrl);
  }

  getDependenciesSearch(inuId){
    let sbUrl = "Index/dependenciesSearch?inuId="+inuId;

    return this.SendRequest(sbUrl);
  }

  SendRequest(isbUrl){
    let sbUrl = this.sbBaseURL+isbUrl;

    // Petición
    return this.Http.get(sbUrl).toPromise()
        .then(iobData => iobData.json());
  }

}
