import { Component, OnInit } from '@angular/core';
import { Ruta } from 'src/app/models/ruta';
import { PeticionesService } from 'src/app/service/peticiones.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {

	public rutasThree: Array<Ruta> = []

	constructor( private _peticiones: PeticionesService ) {}

	ngOnInit(): void {
		this.getThreeRutas()
	}

	public getThreeRutas() {
		this._peticiones.getThreeRutas().subscribe({
			next: data => {
				this.rutasThree = data.data
				console.log('Resultado de getThreeRutas: \n', this.rutasThree);
			},
			error: error => {
				console.log('Error accessing cities data\nERROR: ', error);
				this.rutasThree = []
			}
		})
	}
}
