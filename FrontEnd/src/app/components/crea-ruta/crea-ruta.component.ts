import { AfterViewInit, Component } from '@angular/core';
import { Control, DomUtil, Icon, IconOptions, LatLng, Map, Marker, Polyline, marker, polyline, tileLayer } from 'leaflet';
import { Ruta } from 'src/app/models/ruta';
import { PeticionesService } from 'src/app/service/peticiones.service';

@Component({
	selector: 'app-crea-ruta',
	templateUrl: './crea-ruta.component.html',
	styleUrls: ['./crea-ruta.component.scss']
})
export class CreaRutaComponent implements AfterViewInit {

	public nuevaRuta: Ruta;

	public coordenadas: Array<LatLng> = [];
	private last_coord: Polyline<any>[] = [];
	
	// Triggers
	private markerCounter = 0;
	private polylineCounter = 1;
	
	// Marcadores
	public marcadores: Array<Marker> = [];
	private nuevoMarcador: Marker<any> = new Marker({"lat": 0, "lng": 0});

	// Iconos marcadores
	public customIcon = (options: IconOptions) => {
		return Icon.extend({
			options: {
				iconUrl: options.iconUrl ?? '',
				iconSize: [64, 64],
			}
		})
	}
	public treeIcon = this.customIcon({iconUrl: '../../../assets/leaflet/10097523_garden_tree_nature_destination_location_icon.png'})
	public museumIcon = this.customIcon({iconUrl: '../../../assets/leaflet/10097531_bank_business_finance_destination_location_icon.png'})

	constructor(
		private _peticiones: PeticionesService,
	) {
		this.nuevaRuta = new Ruta(0, '', '', '', undefined, 0, 0, false, this.coordenadas, this.marcadores);
	}

	cambiarPolyline = () => {
		// Cambiar el parámetro en tu componente de Angular
		this.markerCounter = 1;
		this.polylineCounter = 0;
		console.log('Polyline\n');
		console.log(this.markerCounter);
		console.log(this.polylineCounter);
	}
	cambiarMarker = () => {
		// Cambiar el parámetro en tu componente de Angular
		this.markerCounter = 0;
		this.polylineCounter = 1;
		console.log('Marker\n');
		console.log(this.markerCounter);
		console.log(this.polylineCounter);
	}
	cambiarReset = () => {
		// Cambiar el parámetro en tu componente de Angular
		this.markerCounter = 0;
		this.polylineCounter = 0;
		console.log('RESET');
		console.log(this.markerCounter);
		console.log(this.polylineCounter);
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

		// Trigger marker or polyline
		const MapButtons = Control.extend({
			options: {
				position: 'topright',
				className: 'mi-boton',
				url: '../../../assets/leaflet/10097531_bank_business_finance_destination_location_icon.png'
			},
			onAdd: function(): HTMLImageElement {
				const div = DomUtil.create('div')
				const input = DomUtil.create('img', this.options.className, div);
				input.src = this.options.url
				input.style.width = '40px';
				input.style.height = '40px';
				input.style.cursor = 'pointer';
				input.style.backgroundColor = 'white';
				// input.addEventListener('click', () => {})
				return input;
			}
		})
	
		const markerButton = new MapButtons()
		markerButton.addTo(map)
		const polyButton = new MapButtons({position: 'topleft'})

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
				this.nuevoMarcador = marker(e.latlng, {draggable: true, icon: new this.treeIcon()}).addTo(map);
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
