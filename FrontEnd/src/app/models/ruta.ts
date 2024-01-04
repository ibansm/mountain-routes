import { LatLng, Marker } from "leaflet";

export enum Dificultad {
	baja = 'baja',
	media = 'media',
	alta = 'alta'
}

export class Ruta {

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
	constructor(
		public id?: Number,
		public nombre?: String,
		public descripcion?: String,
		public ciudad?: String,
		public dificultad?: Dificultad,
		public longitud?: Number,
		public duracion?: Number,
		public ninos?: Boolean,
		public coordenadas?: Array<LatLng>,
		public marcadores?: Array<Marker>,
		public imagenes?: Array<File>
	) {}
	
}
