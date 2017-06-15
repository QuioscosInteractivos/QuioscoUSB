import { Injectable } from '@angular/core';
import { Http } from "@angular/http/";
import 'rxjs/add/operator/toPromise';

@Injectable()
export class ServicesUtilities {

    constructor(private Http: Http) { }

    sbBaseURL: String = "http://localhost/QuioscoUSB/services/";

    SendRequest(isbUrl){
        let sbUrl = this.sbBaseURL+isbUrl;

        // Petición
        return this.Http.get(sbUrl).toPromise()
            .then(iobData => iobData.json());
    }
}
