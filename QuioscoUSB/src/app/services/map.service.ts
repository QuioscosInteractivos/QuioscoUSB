import { Injectable } from '@angular/core';
import { ServicesUtilities } from "app/services/services-utilities";

@Injectable()
export class MapService {

  constructor(private ServicesUtilities: ServicesUtilities) { }

  getMapData(){
    let sbUrl = "Index/mapData";

    return this.ServicesUtilities.SendRequest(sbUrl);
  }

  getMapSearch(isbSearhString){
    let sbUrl = "Index/mapSearch?isbSearhString="+isbSearhString;

    return this.ServicesUtilities.SendRequest(sbUrl);
  }
}
