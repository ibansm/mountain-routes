import { Component, OnInit } from '@angular/core';
import { Ruta } from 'src/app/models/ruta';

@Component({
  selector: 'app-tipo-ruta',
  templateUrl: './tipo-ruta.component.html',
  styleUrls: ['./tipo-ruta.component.scss']
})
export class TipoRutaComponent implements OnInit {
	
	public res: Array<Ruta> = []
	public errorRes: Array<Ruta> = []
	public mensajeHijo: string = ''
	
	ngOnInit(): void {
		// this.getRespuesta()
	}

	onMensajeHijo(mensaje: string) {
		this.mensajeHijo = mensaje
	}
	
}
