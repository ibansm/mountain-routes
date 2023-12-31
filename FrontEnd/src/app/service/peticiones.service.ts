import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Ruta } from '../models/ruta';

@Injectable({ providedIn: 'root' })
export class PeticionesService {

	public baseUrl = 'http://localhost:8000/api'
	
	constructor(public _http: HttpClient) { }


	getCiudades(): Observable<any> {
		return this._http.get(`${this.baseUrl}/ciudades`)
	}

	getDificultad(): Observable<any> {
		return this._http.get(`${this.baseUrl}/dificultad`)
	}

	getRutas(): Observable<any> {
		return this._http.get(`${this.baseUrl}/rutas`)
	}
	
	getRuta(id : number): Observable<any> {
		return this._http.get(`${this.baseUrl}/rutas/${id}`)
	}

	buscadorForm(data : any): Observable<any> {
		return this._http.post(`${this.baseUrl}/buscador`, data)
	}

	creaRuta(nuevaRuta: Ruta): Observable<any> {
		return this._http.post(`${this.baseUrl}/rutas`, nuevaRuta, {observe: 'response'})
	}

}
