import { Component } from '@angular/core';
import { PeticionesService } from 'src/app/service/peticiones.service';

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html',
  styleUrls: ['./menu.component.scss']
})
export class MenuComponent {

	constructor ( private _peticiones: PeticionesService ) {}
	
	toggle() : void {
		document.querySelector('#navbarNav')?.classList.toggle('collapse');
	}

	getLog(): boolean {
		return this._peticiones.isLogged
	}

	logOut(): void {
		this._peticiones.isLogged = false
	}
}
