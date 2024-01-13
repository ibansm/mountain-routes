import { Component, OnInit } from '@angular/core';
import { Ruta } from 'src/app/models/ruta';
import { PeticionesService } from 'src/app/service/peticiones.service';

@Component({
  selector: 'app-tipo-ruta',
  templateUrl: './tipo-ruta.component.html',
  styleUrls: ['./tipo-ruta.component.scss']
})
export class TipoRutaComponent implements OnInit {
	
	public res: Array<Ruta> = [{nombre: 'IAKITO'}];
	public errorRes: Array<Ruta> = []
	public mensajeHijo: string = ''

	constructor( private _peticiones: PeticionesService ) {}
	
	ngOnInit(): void {

		this.res = this._peticiones.getResponse()
		this.getRutas()
		console.log('DESDE TIPO-RUTA\n');
		console.log(this.res);	
	}

	public getRutas() {
		this._peticiones.getRutas().subscribe({
			next: data => {
				this.errorRes = data.data
			},
			error: error => {
				console.log('Error accessing cities data\nERROR: ', error);
				this.errorRes = []
			}
		})
	}

	public getTrigger(): boolean {
		return this._peticiones.hasBeenTouchedBuscador = true
	}
}
