import { Injectable } from '@angular/core';
import { ServicesUtilities } from "app/services/services-utilities";

@Injectable()
export class DirectoryService {

  constructor(private ServicesUtilities: ServicesUtilities) {}

  getUnits(){
    let sbUrl = "Index/units";

    // Petición
    return this.ServicesUtilities.SendRequest(sbUrl);
  }

  getDependencies(inuId){
    let sbUrl = "Index/dependencies?inuId="+inuId;

    return this.ServicesUtilities.SendRequest(sbUrl);
  }

  getDependenciesSearch(inuId){
    let sbUrl = "Index/dependenciesSearch?inuId="+inuId;

    return this.ServicesUtilities.SendRequest(sbUrl);
  }
}
