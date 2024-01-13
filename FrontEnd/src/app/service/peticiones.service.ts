import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Ruta } from '../models/ruta';

@Injectable({ providedIn: 'root' })
export class PeticionesService {

	public baseUrl = 'http://localhost:8000/api'
	
	constructor(public _http: HttpClient) { }

	public accessToken = localStorage.getItem("access_token");
	public tokenType = localStorage.getItem("token_type");
	public myheaders = new HttpHeaders;

	createHeader() {
		if (this.accessToken !== null && this.tokenType !== null) {
			this.myheaders.set ( 'access_token', this.accessToken );
			this.myheaders.set ( 'token_type', this.tokenType );
		  }
	}

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

	buscadorForm(data : string): Observable<any> {
		return this._http.post(`${this.baseUrl}/buscador`, data, {observe: 'response'})
	}

	creaRuta(nuevaRuta: Ruta): Observable<any> {
		return this._http.post(`${this.baseUrl}/rutas`, nuevaRuta, {observe: 'response'})
	}

	// El numero es la cantidad de ocurrencias que se quieren recuperar
	getLastRutas(id: number): Observable<any> {
		return this._http.get(`${this.baseUrl}/rutas/ultimas/` + id)
	}

	getFotos(id: number): Observable<any> {
		return this._http.get(`` + id);
	}

	postLogin(data : any): Observable<any> {
		return this._http.post(`${this.baseUrl}/login`, data)
	}

	postLogout(data : any, header : any): Observable<any> {

		return this._http.post(`${this.baseUrl}/logout`, data, {headers:this.myheaders})
	}

	postRegistrarse(data : any): Observable<any> {
		return this._http.post(`${this.baseUrl}/registrarse`, data)
	}
	

}
