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
	public rutasAll: Array<Ruta> = []
	public carreras: Array<any> = []

	constructor( private _peticiones: PeticionesService ) {}

	ngOnInit(): void {
		this.getThreeRutas()
		this.getRutasAll()
		this.getCarreras()
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

	public getRutasAll() {
		this._peticiones.getRutas().subscribe({
			next: data => {
				this.rutasAll = data.data
			},
			error: error => {
				console.log('Error accessing cities data\nERROR: ', error);
				this.rutasThree = []
			}
		})
	}

	public getCarreras() {
		this._peticiones.getCarreras().subscribe({
			next: data => {
				this.carreras = data.data
				console.log('CARRERAS')				
				console.log(data);
				
			},
			error: error => {
				console.log('Error accessing cities data\nERROR: ', error);
				this.rutasThree = []
			}
		})
	}
}
