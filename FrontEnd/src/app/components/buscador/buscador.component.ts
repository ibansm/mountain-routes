import { Component } from '@angular/core';
import { PeticionesService } from 'src/app/service/peticiones.service';

@Component({
	selector: 'app-buscador',
	templateUrl: './buscador.component.html',
	styleUrls: ['./buscador.component.scss'],
	providers: [PeticionesService]
})
export class BuscadorComponent {

	buscadorData = {}

	constructor(
		private _peticiones: PeticionesService
	) { }

	public getCiudades() {
		this._peticiones.getCiudades().subscribe({
			next: data => {
				console.log('La data de getCiudades(): ', data)
			},
			error: error => { }
		})
	}

	buscadorForm() {
		this._peticiones.buscadorForm(this.buscadorData).subscribe({
			next: data => { },
			error: error => { }
		})
	}

	ngOnInit() {
		this.getCiudades();
	}

	public userArray: any = [
		"Iako",
		"Ivan",
		"Juncal",
		"Unai"
	]

	public cityArray: any = [
		"Bilbo",
		"Algorta"
	]

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
}
