import { Component, OnInit } from '@angular/core';
import { Ruta } from 'src/app/models/ruta';
import { PeticionesService } from 'src/app/service/peticiones.service';

@Component({
  selector: 'app-horizontal-card',
  templateUrl: './horizontal-card.component.html',
  styleUrls: ['./horizontal-card.component.scss'],
  providers: [PeticionesService]
})
export class HorizontalCardComponent implements OnInit {

	public rutasAll: Array<Ruta> = []
	public rutasLast: Array<Ruta> = []

	constructor( private _peticiones: PeticionesService ) {}
	
	ngOnInit(): void {
		this.getRutas()
		this.getLastRutas()
	}

	public getRutas() {
		this._peticiones.getRutas().subscribe({
			next: data => {
				this.rutasAll = data.data
				console.log('Resultado de getRutas: \n', this.rutasAll);
			},
			error: error => {
				console.log('Error accessing cities data\nERROR: ', error);
				this.rutasAll = []
			}
		})
	}

	public getLastRutas() {
		this._peticiones.getLastRutas().subscribe({
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
}
