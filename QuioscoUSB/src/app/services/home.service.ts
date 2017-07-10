import { Injectable } from '@angular/core';
import { ServicesUtilities } from "app/services/services-utilities";

@Injectable()
export class HomeService {

  constructor(private ServicesUtilities:ServicesUtilities) { }

  getWelcome(){
    let sbUrl = "Index/welcome";

    // Petición
    return this.ServicesUtilities.SendRequest(sbUrl);
  }

}
