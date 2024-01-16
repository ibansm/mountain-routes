import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { PeticionesService } from 'src/app/service/peticiones.service';

@Component({
  selector: 'app-contacto',
  templateUrl: './contacto.component.html',
  styleUrls: ['./contacto.component.scss']
})
export class ContactoComponent {

	// TODO => Buscar API de terceros para enviar los mails
	public contactForm: FormGroup;

	public mailContent: string = '';
	
	constructor (
		private fb: FormBuilder,
		private _peticiones: PeticionesService
	) {
		this.contactForm = this.fb.group({
			nombre: ['', Validators.required],
			email: ['', [Validators.required, Validators.email]],
			texto: []
		})
	}

	contactSubmit(): void {
		this.mailContent += this.contactForm.value.nombre
		this.mailContent += ' ' + this.contactForm.value.email
		this.mailContent += ' ' + this.contactForm.value.texto
		console.log(this.mailContent);

		// Envio del email
		this._peticiones.enviarMailto()
	}

	hasErrors(controlName: string, errorType: string) {
		return this.contactForm.get(controlName)?.hasError(errorType) && this.contactForm.get(controlName)?.touched
	}
}
