import { Component, OnInit } from '@angular/core';
import { PeticionesService } from 'src/app/service/peticiones.service';
import { ActivatedRoute  } from '@angular/router';
import { Location } from '@angular/common';

@Component({
  selector: 'app-info-ruta',
  //imports: [],
  templateUrl: './info-ruta.component.html',
  styleUrls: ['./info-ruta.component.scss'],
  providers: [PeticionesService]
})
export class InfoRutaComponent implements OnInit {
	constructor( private _peticiones: PeticionesService, private route: ActivatedRoute, private location: Location ) {}

	public ruta: any;
	public currentURL: string = this.location.path();
	//public urlTree = this.urlSerializer.parse(this.currentURL);
	public id : string = "";




	
	ngOnInit(): void {
		console.log('Current URL:-> ', this.currentURL);
		//console.log('Parsed URL Tree:', this.urlTree);
		this.route.params.subscribe(params => {
			this.id = params['id'];
			console.log('Route Parameter - ID:', this.id);
		  });
		this.getRuta();
	}

	public getRuta() {
		this._peticiones.getRuta(parseInt(this.id, 10)).subscribe({
			
			next: data => {
				this.ruta = data.data
				console.log('Resultado de getRutas: \n', this.ruta);
			},
			error: error => {
				console.log('Error accessing cities data\nERROR: ', error);
				this.ruta = []
			}
		})
	}
}
