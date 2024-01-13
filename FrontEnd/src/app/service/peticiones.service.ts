import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Ruta } from '../models/ruta';

@Injectable({ providedIn: 'root' })
export class PeticionesService {

	
	public accessToken = localStorage.getItem("access_token");
	public tokenType = localStorage.getItem("token_type");
	public myheaders = new HttpHeaders;
	// Base URL
	public baseUrl = 'http://localhost:8000/api'

	// url servidor BirtLH + API-BackEnd
	// public baseUrl = 'https://daw4win10.hosting.birt.eus/public/api'
	// Respuesta
	public respuesta: Array<Ruta> = []
	// Variables globales
	public hasBeenTouchedBuscador: boolean = false;
	public isLogged: boolean = false;

	constructor(public _http: HttpClient) { }

	setResponse(data: Array<Ruta>) {
		this.respuesta = data
	}

	getResponse(): Array<Ruta> {
		return this.respuesta
	}

	createHeader() {
		if (this.accessToken !== null && this.tokenType !== null) {
			this.myheaders.set('access_token', this.accessToken);
			this.myheaders.set('token_type', this.tokenType);
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

	getRuta(id: number): Observable<any> {
		return this._http.get(`${this.baseUrl}/rutas/${id}`)
	}

	buscadorForm(data: string): Observable<any> {
		return this._http.post(`${this.baseUrl}/buscador`, data, { observe: 'response' })
	}

	creaRuta(nuevaRuta: Ruta): Observable<any> {
		return this._http.post(`${this.baseUrl}/rutas`, nuevaRuta, { observe: 'response' })
	}

	// El numero es la cantidad de ocurrencias que se quieren recuperar
	getLastRutas(id: number): Observable<any> {
		return this._http.get(`${this.baseUrl}/rutas/ultimas/` + id)
	}

	getFotos(id: number): Observable<any> {
		return this._http.get(`` + id);
	}

	postLogin(data: any): Observable<any> {
		return this._http.post(`${this.baseUrl}/login`, data)
	}

	postLogout(data: any, header: any): Observable<any> {

		return this._http.post(`${this.baseUrl}/logout`, data, { headers: this.myheaders })
	}

	postRegistrarse(data: any): Observable<any> {
		return this._http.post(`${this.baseUrl}/registrarse`, data)
	}

	// FIXME => Ver como se puede hallar el user_id por un endpoint
	getUserId(): Observable<any> {
		return this._http.get(`${this.baseUrl}/userId`)
	}

}
