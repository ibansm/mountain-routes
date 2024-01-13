import { LatLng, Marker } from "leaflet";

export enum Dificultad {
	baja = 'baja',
	media = 'media',
	alta = 'alta'
}

export class Ruta {

	constructor(
		public id?: number,
		public nombre?: string,
		public descripcion?: string,
		public ciudad?: string,
		public dificultad?: Dificultad,
		public longitud?: number,
		public duracion?: number,
		public ninos?: boolean,
		public coordenadas?: Array<LatLng>,
		public marcadores?: Array<Marker>,
		public imagenes?: Array<File>
	) {}
	
}
