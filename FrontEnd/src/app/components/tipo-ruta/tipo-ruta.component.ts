import { Component, OnInit, Output } from '@angular/core';
import { Ruta } from 'src/app/models/ruta';
import { PeticionesService } from 'src/app/service/peticiones.service';

@Component({
  selector: 'app-tipo-ruta',
  templateUrl: './tipo-ruta.component.html',
  styleUrls: ['./tipo-ruta.component.scss']
})
export class TipoRutaComponent implements OnInit {
	
	// public res: Array<Ruta> = [];
	// public errorRes: Array<Ruta> = []
	// public mensajeHijo: string = ''

	@Output() dataBuscador: Array<Ruta> = []
	
	constructor( private _peticiones: PeticionesService ) {
	}
	
	ngOnInit(): void {
		// this.getResponse()
		// this._peticiones.obser2.subscribe(data => this.dataBuscador = data)
		this._peticiones.respuestaBuscador.subscribe(data => {
			this.dataBuscador = data
			console.log(data)
		})
	}

	public getTrigger(): boolean {
		return this._peticiones.hasBeenTouchedBuscador = true
	}

	// public getResponse() {
	// 	this._peticiones.obser2.pipe(take(1)).subscribe(data => {
	// 		this.dataBuscador = data
	// 		console.log('ON_INIT - TipoRuta');
	// 		console.log(data);
	// 		console.log('DATA BUSCADOR');
	// 		console.log(this.dataBuscador);
	// 	})
	// }
}
