import { Component, OnInit } from '@angular/core';
import { Ruta } from 'src/app/models/ruta';
import { PeticionesService } from 'src/app/service/peticiones.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {

	public rutasAll: Array<Ruta> = []

	constructor( private _peticiones: PeticionesService ) {}

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
}
