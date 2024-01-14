import { Component, Input } from '@angular/core';
import { Router } from '@angular/router';
import { Ruta } from 'src/app/models/ruta';
import { PeticionesService } from 'src/app/service/peticiones.service';

@Component({
  selector: 'app-horizontal-card',
  templateUrl: './horizontal-card.component.html',
  styleUrls: ['./horizontal-card.component.scss'],
  providers: [PeticionesService]
})
export class HorizontalCardComponent {

	@Input() datosPadre: Array<Ruta> = []
	
	public dataRespuesta: Array<Ruta> = []
	
	constructor( private _peticiones: PeticionesService, private route: Router ) {}

	ngOnInit(): void {
		
	}

	toRuta(id: number | undefined) {
		if (id === undefined) {
			console.log('El id de la ruta no puede ser undefined');
		} else {
			this.route.navigate(['/info-ruta/' + id])
		}
	}
}
