import { Component } from '@angular/core';

@Component({
  selector: 'app-contacto',
  templateUrl: './contacto.component.html',
  styleUrls: ['./contacto.component.scss']
})
export class ContactoComponent {

	// TODO => Reactive Form para poder recoger la info del formulario y enviarla por email
	public mailContent: string = '';

	public mailtoString: String = 'mailto:info@mountainroutes.com?subject=ContactoMountainRoutes&body=' + encodeURIComponent(this.mailContent);
}
