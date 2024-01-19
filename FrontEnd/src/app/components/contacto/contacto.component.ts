import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { PeticionesService } from 'src/app/service/peticiones.service';
import Swal from 'sweetalert2';

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
		private _peticiones: PeticionesService,
		private route: Router
	) {
		this.contactForm = this.fb.group({
			nombre: ['', Validators.required],
			email: ['', [Validators.required, Validators.email]],
			texto: ['']
		})
	}

	contactSubmit(): void {
		const nombre: string = this.contactForm.get('nombre')?.value
		const email: string = this.contactForm.get('email')?.value
		const mensaje: string = this.contactForm.get('texto')?.value
		let contacto: any;


		if (nombre == '' || email == '' || mensaje== '') {
			Swal.fire({
			  position: 'center',
			  icon: 'error',
			  title: 'Hay algún campo vacío. Revísalo',
			  showConfirmButton: true,
			}) 
			return;

		} else {
			contacto = {
				nombre: nombre,
				email: email,
				mensaje: mensaje
			}

			// Envio del email
			this._peticiones.sendMessageFromContact(contacto).subscribe({
				next: data => {
					Swal.fire({
						position: 'center',
						icon: 'success',
						title: 'Mensaje enviado!',
						showConfirmButton: true,
					  }).then( (result)=>{
						if (result.isConfirmed) {
							this.contactForm.reset();
							this.route.navigate(['/contacto'])
						}
					  })
					console.log('Contacto enviado con éxito: ', JSON.stringify(data));
				},
				error: error => {
					console.log('Error', JSON.stringify(error))
				}
			})
		}
	}

	hasErrors(controlName: string, errorType: string) {
		return this.contactForm.get(controlName)?.hasError(errorType) && this.contactForm.get(controlName)?.touched
	}
}
