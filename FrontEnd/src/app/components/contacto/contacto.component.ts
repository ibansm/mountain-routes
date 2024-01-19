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

	public nombre:string = '';
	public email:string = '';
	public mensaje:string = '';
	public contacto:any;
	
	constructor (
		private fb: FormBuilder,
		private _peticiones: PeticionesService,
		private route: Router
	) {
		this.contactForm = this.fb.group({
			nombre: ['', Validators.required],
			email: ['', [Validators.required, Validators.email]],
			texto: []
		})
	}

	contactSubmit(): void {

		if (this.nombre == '' || this.email == '' || this.mensaje== '') {
			Swal.fire({
			  position: 'center',
			  icon: 'error',
			  title: 'Hay algún campo vacío. Revísalo',
			  showConfirmButton: true,
			}) 
			return;
		} else {

			this.contacto = {
				nombre: this.nombre,
				email: this.email,
				mensaje: this.mensaje
			}
		// this.mailContent += this.contactForm.value.nombre
		// this.mailContent += ' ' + this.contactForm.value.email
		// this.mailContent += ' ' + this.contactForm.value.texto
		// console.log(this.mailContent);

		// Envio del email
		// this._peticiones.enviarMailto()

			this._peticiones.sendMessageFromContact(this.contacto).subscribe({
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
