import { AfterViewInit, Component } from '@angular/core';
import { LatLng, Map, Marker, Polyline, marker, polyline, tileLayer } from 'leaflet';
import { Ruta } from 'src/app/models/ruta';
import { PeticionesService } from 'src/app/service/peticiones.service';

@Component({
	selector: 'app-crea-ruta',
	templateUrl: './crea-ruta.component.html',
	styleUrls: ['./crea-ruta.component.scss']
})
export class CreaRutaComponent implements AfterViewInit {

	public nuevaRuta: Ruta;
			// 'nombre',
            // 'descripcion',
            // 'longitud',
            // 'duracion',
            // 'ciudad',
			// 'ninos',
            // 'fecha_creada',
            // 'fecha_realizada',
            // 'coordenadas',
            // 'dificultad',
            // 'foto_perfil',
            // 'usuarios_id',

	// public nombre?: String;
	// public descripcion?: String;
	// public ciudad?: String;
	// public dificultad?: Dificultad;
	// public longitud?: Number;
	// public duracion?: Number;
	// public ninos?: Boolean;
	public coordenadas: Array<LatLng> = [];
	private last_coord: Polyline<any>[] = [];
	
	// Triggers
	private markerCounter = 1;
	private polylineCounter = 0;
	
	// Marcadores
	public marcadores: Array<Marker> = [];
	private nuevoMarcador: Marker<any> = new Marker({"lat": 0, "lng": 0});

	constructor(
		private _peticiones: PeticionesService
	) {
		this.nuevaRuta = new Ruta(0, '', '', '', undefined, 0, 0, false, this.coordenadas, this.marcadores);
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

		// Coordenadas
		if (this.markerCounter === 0 && this.polylineCounter === 1) {
			
			/*
				TODO => Comprobar que se puede guardar el RUTA
			*/
			map.on('click', (event) => {
				this.coordenadas?.push(event.latlng);
				this.last_coord.push(polyline(this.coordenadas).addTo(map));
				console.log('PUSH - Coordenadas\n');
				console.log(this.last_coord);
			})

			map.on('contextmenu', () => {
				this.last_coord[this.last_coord.length - 1].remove()
				this.last_coord.pop()
				this.coordenadas.pop()
				console.log('POP - Coordenadas\n');
				console.log(this.last_coord);
			})
		// Marcadores
		} else if (this.markerCounter === 1 && this.polylineCounter === 0) {
			
			map.on('click', (e) => {
				this.nuevoMarcador = marker(e.latlng, {draggable: true}).addTo(map);
				this.marcadores.push(this.nuevoMarcador);
				console.log('PUSH\n');
				console.log(this.marcadores);
			})

			map.on('contextmenu', (e) => {
				this.marcadores[this.marcadores.length - 1].remove()
				this.marcadores.pop()
				console.log('POP\n');
				console.log(this.marcadores);
			})

		}
			

	}


}
