import { AfterViewInit, Component, OnInit } from '@angular/core';
import { Control, DomUtil, Icon, IconOptions, LatLng, Map, Marker, Polyline, marker, polyline, tileLayer } from 'leaflet';
import { Ruta } from 'src/app/models/ruta';
import { PeticionesService } from 'src/app/service/peticiones.service';

@Component({
	selector: 'app-crea-ruta',
	templateUrl: './crea-ruta.component.html',
	styleUrls: ['./crea-ruta.component.scss']
})
export class CreaRutaComponent implements AfterViewInit, OnInit {
	public formData = new FormData()

	public rutasLast: Array<Ruta> = []

	public nuevaRuta: Ruta;

	public coordenadas: Array<LatLng> = [];
	private last_coord: Polyline<any>[] = [];

	// Triggers
	private markerCounter = 0;
	private polylineCounter = 1;

	// Marcadores
	public marcadores: Array<Marker> = [];
	private nuevoMarcador: Marker<any> = new Marker({ "lat": 0, "lng": 0 });

	// Iconos marcadores
	public customIcon = (options: IconOptions) => {
		return Icon.extend({
			options: {
				iconUrl: options.iconUrl ?? '',
				iconSize: [64, 64],
			}
		})
	}
	public treeIcon = this.customIcon({ iconUrl: '../../../assets/leaflet/10097523_garden_tree_nature_destination_location_icon.png' })
	public museumIcon = this.customIcon({ iconUrl: '../../../assets/leaflet/10097531_bank_business_finance_destination_location_icon.png' })

	constructor(
		private _peticiones: PeticionesService,
	) {
		this.nuevaRuta = new Ruta(undefined, undefined, undefined, undefined, undefined, undefined, undefined, false, undefined, this.coordenadas);
	}

	ngOnInit(): void {
		this.getLastRutas(2)
	}

	getLastRutas(id: number) {
		this._peticiones.getLastRutas(id).subscribe({
			next: data => {
				this.rutasLast = data.data
				console.log('Resultado de rutasLast: \n', this.rutasLast);
			},
			error: error => {
				console.log('Error accessing cities data\nERROR: ', error);
				this.rutasLast = []
			}
		})
	}

	guardaRuta(): void {
		console.log(this.nuevaRuta);
		this.nuevaRuta.usuarios_id = parseFloat(localStorage.getItem('user_id') || '')

		this.formData.append('nombre', this.nuevaRuta.nombre || '')
		this.formData.append('descripcion', this.nuevaRuta.descripcion || '')
		this.formData.append('ciudad', this.nuevaRuta.ciudad || '')
		this.formData.append('dificultad', this.nuevaRuta.dificultad || '')
		this.formData.append('longitud', String(this.nuevaRuta.longitud || 0))
		this.formData.append('duracion', String(this.nuevaRuta.duracion || 0))
		this.formData.append('ninos', String(this.nuevaRuta.ninos || 0))
		this.formData.append('usuarios_id', String(this.nuevaRuta.usuarios_id || 0))
		this.formData.append('coordenadas', String(this.nuevaRuta.coordenadas || []))
		console.log('El nombre del formData es: \n' + this.formData.get('ninos'))
		console.log('El tipo de la data del formData es: \n' + typeof(this.formData.get('ninos')))






		this._peticiones.creaRuta(this.formData).subscribe({
			next: data => {
				this.getLastRutas(2)
				console.log(data)
			},
			error: error => {
				console.log('Error a la hora de guardar la ruta.\n');
				console.log(error.status + ' ' + error.statusText);
			}
		})
	}

	guardaFormData(event: any) {
		const file = event.target.files[0]
		if (file) {
			this.encodeImageToBase64(file).then(
				base => {
					this.nuevaRuta.foto_perfil = base
					console.log(this.nuevaRuta.foto_perfil);
				}
			).catch( error => console.error(error) )
		}
		this.nuevaRuta.foto_perfil = event.target.files[0]
	}

	private encodeImageToBase64(file: File): Promise<string> {
		return new Promise<string>((resolve, reject) => {
			const reader = new FileReader()

			reader.onloadend = () => {
				if (typeof reader.result === 'string') {
					resolve(reader.result)
				} else {
					reject('Error al leer la imagen.')
				}
			};

			// Lee el contenido de la imagen como una URL de datos (base64)
			reader.readAsDataURL(file)
		});
	}

	guardaImagen(event: any) {
		console.log('EVENT - IMAGE')
		console.log(event.target.files[0])
		this.formData.append('foto_perfil', event.target.files[0], 'foto_iako.png')
		console.log(event.target.files[0].name)
	}

	ngAfterViewInit(): void {
		const map = new Map('map').setView([43.263, -2.93501], 15);

		tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

		// BOTON - MARKER OR POLYLINE
			// const MapButtons = Control.extend({
			// 	options: {
			// 		position: 'topright',
			// 		className: 'mi-boton',
			// 		url: '../../../assets/leaflet/10097531_bank_business_finance_destination_location_icon.png'
			// 	},
			// 	onAdd: function(): HTMLImageElement {
			// 		const div = DomUtil.create('div')
			// 		const input = DomUtil.create('img', this.options.className, div);
			// 		input.src = this.options.url
			// 		input.style.width = '40px';
			// 		input.style.height = '40px';
			// 		input.style.cursor = 'pointer';
			// 		input.style.backgroundColor = 'white';
			// 		// input.addEventListener('click', () => {})
			// 		return input;
			// 	}
			// })

			// const markerButton = new MapButtons()
			// markerButton.addTo(map)
			// const polyButton = new MapButtons({position: 'topleft'})

		// Coordenadas
		if (this.markerCounter === 0 && this.polylineCounter === 1) {

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
				this.nuevoMarcador = marker(e.latlng, { draggable: true, icon: new this.treeIcon() }).addTo(map);
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
