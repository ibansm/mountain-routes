import { Component, Input, OnChanges, SimpleChanges } from '@angular/core';
import { Router } from '@angular/router';
import { Ruta } from 'src/app/models/ruta';
import { PeticionesService } from 'src/app/service/peticiones.service';
import { Location } from '@angular/common';

@Component({
	selector: 'app-horizontal-card',
	templateUrl: './horizontal-card.component.html',
	styleUrls: ['./horizontal-card.component.scss'],
})
export class HorizontalCardComponent implements OnChanges {

	@Input() datosPadre: Array<Ruta> = []
	public dataBuscador: Array<Ruta> = []

	constructor(private _peticiones: PeticionesService, private route: Router, private location: Location) { }
	ngOnChanges(changes: SimpleChanges): void {
		if (changes['datosPadre']) {
			this.dataBuscador = changes['datosPadre'].currentValue
			console.log(this.dataBuscador);
			console.log('CAMBIANDO');
			console.log(this._peticiones.empty);
		}
	}

	ngOnInit(): void {
		this._peticiones.respuestaBuscador.subscribe(data => {
			this.dataBuscador = data
			console.log(data)
		})
	}

	toRuta(id: number | undefined) {
		if (id === undefined) {
			console.log('El id de la ruta no puede ser undefined');
		} else {
			this.route.navigate(['/info-ruta/' + id])
		}
	}

	reloadPage(): void {
		if (this.location.isCurrentPathEqualTo('/tipo-ruta')) {
			console.log('location is current')
		}
	}

	deleteCard(id: number| undefined) {
		this._peticiones.deleteRuta(id ?? 0)
	}

}
