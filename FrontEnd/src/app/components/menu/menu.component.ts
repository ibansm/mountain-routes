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
		return this._peticiones.isLogged()
	}

	logOut(): void {
		localStorage.removeItem("access_token")
		localStorage.removeItem("token_type")
		localStorage.removeItem("user_id")
	}
}
