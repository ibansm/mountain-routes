import { AfterViewInit, Component } from '@angular/core';
import { LatLng, Map, polyline, tileLayer } from 'leaflet';
import { Ruta, Dificultad } from 'src/app/models/ruta';
import { PeticionesService } from 'src/app/service/peticiones.service';

@Component({
	selector: 'app-crea-ruta',
	templateUrl: './crea-ruta.component.html',
	styleUrls: ['./crea-ruta.component.scss']
})
export class CreaRutaComponent implements AfterViewInit {

	public nuevaRuta: Ruta;

	// public nombre?: String;
	// public descripcion?: String;
	// public ciudad?: String;
	// public dificultad?: Dificultad;
	// public longitud?: Number;
	// public duracion?: Number;
	// public ninos?: Boolean;
	public coordenadas: Array<LatLng> = [];

	constructor(
		private _peticiones: PeticionesService
	) {
		this.nuevaRuta = new Ruta('', '', '', undefined, 0, 0, false, this.coordenadas);
	}
	
	guardaRuta(): void {
		console.log(this.nuevaRuta);
		this._peticiones.creaRuta(this.nuevaRuta).subscribe({
			next: data => {
				console.log(data)
			},
			error: error => {
				console.log('Error a la hora de guardar la ruta.\n' + error);
			}
		})
	}

	ngAfterViewInit(): void {
		const map = new Map('map').setView([43.263, -2.93501], 15);

		tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

		map.on('click', (event) => {
			this.nuevaRuta.coordenadas?.push(event.latlng);
			polyline(this.coordenadas).addTo(map);
			console.log(this.coordenadas);
		})

	}


}
