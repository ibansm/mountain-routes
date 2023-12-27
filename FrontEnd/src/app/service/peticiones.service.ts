import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';

@Injectable({ providedIn: 'root' })
export class PeticionesService {

	public baseUrl = 'http://localhost:8000/api'
	constructor(public _http: HttpClient) { }

	/**
	 * This function gets all the 'cities' from 'rutas'
	 * @returns An observable to that endpoint
	 */
	getCiudades(): Observable<any> {
		return this._http.get(`${this.baseUrl}/ciudades`)
	}
	/**
	 * This function gets all the 'dificultad' from 'rutas'
	 * @returns An observable to that endpoint
	 */
	getDificultad(): Observable<any> {
		return this._http.get(`${this.baseUrl}/dificultad`)
	}

	getRutas(): Observable<any> {
		return this._http.get(`${this.baseUrl}/rutas`)
	}
	getRuta(id : number): Observable<any> {
		return this._http.get(`${this.baseUrl}/rutas/${id}`)
	}
	/**
	 * This function sends the data to be searched from 'rutas'
	 * @param data -> The data to be searched
	 * @returns An observable to that endpoint
	 */
	buscadorForm(data : any): Observable<any> {
		return this._http.post(`${this.baseUrl}/buscador`, data)
	}

}
