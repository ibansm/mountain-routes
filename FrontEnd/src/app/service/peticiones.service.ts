import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({ providedIn: 'root' })
export class PeticionesService {

	constructor(public _http: HttpClient) { }

	/**
	 * This function gets all the 'cities' from 'rutas'
	 * @returns An observable to that endpoint
	 */
	getCiudades(): Observable<any> {
		return this._http.get('http://localhost:8000/api/ciudades')
	}
	/**
	 * This function gets all the 'dificultad' from 'rutas'
	 * @returns An observable to that endpoint
	 */
	getDificultad(): Observable<any> {
		return this._http.get('http://localhost:8000/api/dificultad')
	}

	/**
	 * This function sends the data to be searched from 'rutas'
	 * @param data -> The data to be searched
	 * @returns An observable to that endpoint
	 */
	buscadorForm(data : any): Observable<any> {
		return this._http.post('http://localhost:8000/api/buscador', data)
	}

}
