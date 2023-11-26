import { Component } from '@angular/core';

@Component({
	selector: 'app-buscador',
	templateUrl: './buscador.component.html',
	styleUrls: ['./buscador.component.scss']
})
export class BuscadorComponent {

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
}
