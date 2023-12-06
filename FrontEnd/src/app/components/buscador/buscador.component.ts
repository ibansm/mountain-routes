import { Component, OnInit } from '@angular/core';
import { PeticionesService } from 'src/app/service/peticiones.service';

@Component({
	selector: 'app-buscador',
	templateUrl: './buscador.component.html',
	styleUrls: ['./buscador.component.scss'],
	providers: [PeticionesService]
})

export class BuscadorComponent implements OnInit {

	public buscadorData: any = {}

	public dificultadArray: any = []

	public cityArray: any = []

	public distanciaArray: any = [
		"<5km",
		">5km y <10km",
		">10km"
	]

	public duracionArray: any = [
		"<2h",
		">2h y <4h",
		">4h y <6h"
	]

	public longitud: any = [
		"< 5km",
		"< 10km"
	]

	constructor(
		private _peticiones: PeticionesService
	) { }

	public getCiudades() {
		this._peticiones.getCiudades().subscribe({
			next: data => {
				for (let city of data.data) {
					this.cityArray.push(city.ciudad)
				}
			},
			error: error => {
				console.log('Error accessing cities data\nERROR: ', error);
				this.cityArray = []
			}
		})
	}

	public getDificultad() {
		this._peticiones.getDificultad().subscribe({
			next: data => {
				for (let dif of data.data) {
					this.dificultadArray.push(dif.dificultad)
				}
			},
			error: error => {
				console.log('Error accessing dificultad data\nERROR: ', error);
				this.dificultadArray = []
			}
		})
	}

	buscadorForm() {
		this._peticiones.buscadorForm(this.buscadorData).subscribe({
			next: data => { },
			error: error => { }
		})
	}

	ngOnInit() {
		this.getCiudades()
		this.getDificultad()
	}

	
}
