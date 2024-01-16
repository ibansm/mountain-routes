import { Component } from '@angular/core';
import { PeticionesService } from 'src/app/service/peticiones.service';

@Component({
  selector: 'app-footer',
  templateUrl: './footer.component.html',
  styleUrls: ['./footer.component.scss']
})
export class FooterComponent {

	constructor( private _peticiones: PeticionesService ) {}

	mailTo() {
		this._peticiones.enviarMailto()
	}
}
