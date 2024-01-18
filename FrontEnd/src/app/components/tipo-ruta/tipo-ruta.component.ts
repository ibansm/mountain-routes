import { Component, ElementRef, OnInit, ViewChild } from '@angular/core';
import { Ruta } from 'src/app/models/ruta';
import { PeticionesService } from 'src/app/service/peticiones.service';

@Component({
  selector: 'app-tipo-ruta',
  templateUrl: './tipo-ruta.component.html',
  styleUrls: ['./tipo-ruta.component.scss']
})
export class TipoRutaComponent implements OnInit {
	
	// public errorRes: Array<Ruta> = []
	// public mensajeHijo: string = ''
	
	public arrayRutas: Array<Ruta> = []
	public dataBuscador: Array<Ruta> = []
	@ViewChild('myDiv') myDiv!: ElementRef
	
	constructor( private _peticiones: PeticionesService ) {
	}
	
	ngOnInit(): void {
		this.getAll()
		
		this._peticiones.respuestaBuscador.subscribe(data => {
			if (data === 'Lo sentimos,no hemos encontrado ninguna ruta') {
				this._peticiones.empty = true
				this.dataBuscador = data
			} else {
				this.dataBuscador = data
			}
		})		
	}

	ngAfterViewInit() {
		if (this.myDiv) {
			this.myDiv.nativeElement.addEventListener('load', () => {
				this._peticiones.resetBuscador()
			})
		}
	}

	getTrigger(): boolean {
		return this._peticiones.hasBeenTouchedBuscador
	}

	getEmpty(): boolean {
		return this._peticiones.empty
	}

	getAll() {
		this._peticiones.getRutas().subscribe(data => {
			this.arrayRutas = data.data
		})
	}
}
