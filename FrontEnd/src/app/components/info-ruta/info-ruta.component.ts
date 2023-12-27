import { Component, OnInit } from '@angular/core';
import { PeticionesService } from 'src/app/service/peticiones.service';


@Component({
  selector: 'app-info-ruta',
  //imports: [],
  templateUrl: './info-ruta.component.html',
  styleUrls: ['./info-ruta.component.scss'],
  providers: [PeticionesService]
})
export class InfoRutaComponent implements OnInit {
	public rutasAll: any = []

	constructor( private _peticiones: PeticionesService ) {}
	
	ngOnInit(): void {
		//this.getRutas()
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
