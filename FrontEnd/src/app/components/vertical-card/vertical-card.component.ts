import { Component, OnInit } from '@angular/core';
import { Ruta } from 'src/app/models/ruta';
import { PeticionesService } from 'src/app/service/peticiones.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-vertical-card',
  templateUrl: './vertical-card.component.html',
  styleUrls: ['./vertical-card.component.scss']
})
export class VerticalCardComponent implements OnInit {

	public rutasAll: Array<Ruta> = [];

	constructor( 
		private _peticiones: PeticionesService,
		private router: Router
	) {}

	ngOnInit(): void {
		this.getRutas()
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

	public clickCard(id: any) : void {
		this.router.navigate(['info-ruta/:' + id])
	}
}
