import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({providedIn: 'root'})
export class PeticionesService {
	constructor( public _http : HttpClient ) { }
	
	/* Aqui van todas las funciones que necesitemos para realizar las peticiones HTTP */
	prueba() : Observable<any> {
		return this._http.get('localhost:8000/users');
	}
}
