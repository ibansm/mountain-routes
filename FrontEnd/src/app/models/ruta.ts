import { LatLng } from "leaflet";

export enum Dificultad {
	baja = 'baja',
	media = 'media',
	alta = 'alta'
}

export class Ruta {

	constructor(
		public id?: Number,
		public nombre?: String,
		public descripcion?: String,
		public ciudad?: String,
		public dificultad?: Dificultad,
		public longitud?: Number,
		public tiempo?: Number,
		public ninos?: Boolean,
		public coordenadas?: Array<LatLng>,
		public imagenes?: Array<File>
	) {}
	
}
