import { Component, OnInit } from '@angular/core';
import { PeticionesService } from 'src/app/service/peticiones.service';
import { FormBuilder, FormGroup } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
	selector: 'app-buscador',
	templateUrl: './buscador.component.html',
	styleUrls: ['./buscador.component.scss'],
	providers: [PeticionesService]
})

export class BuscadorComponent implements OnInit {

	// Formulario
	public formularioBuscador: FormGroup;

	// Componentes de los select del buscador
	public dificultadArray: any = []
	public cityArray: any = []
	public longitudArray: any = [
		"menos de 5km",
		"entre 5km y 10km",
		"más de 10km"
	]
	public duracionArray: any = [
		"menos de 2h",
		"entre 2h y 4h",
		"más de 4h"
	]

	constructor(
		private _peticiones: PeticionesService,
		private fb: FormBuilder,
		private route: Router
	)
	{
		this.formularioBuscador = this.fb.group({
			ciudad: [''],
			dificultad: [''],
			duracion: [''],
			longitud: [''],
			ninos: [0]
		})
	}

	ngOnInit() {
		this.getCiudades()
		this.getDificultad()
	}
	
	public getCiudades() {
		this._peticiones.getCiudades().subscribe({
			next: data => {
				for (let city of data.data) {
					this.cityArray.push(city.ciudad)
				}
			},
			error: error => {
				console.log('Error accessing cities data\nERROR: ', error);
				this.cityArray = []
			}
		})
	}

	public getDificultad() {
		this._peticiones.getDificultad().subscribe({
			next: data => {
				for (let dif of data.data) {
					this.dificultadArray.push(dif.dificultad)
				}
			},
			error: error => {
				console.log('Error accessing dificultad data\nERROR: ', error);
				this.dificultadArray = []
			}
		})
	}

	public onSubmit(): void {
		console.log('Formulario enviado => \n');
		console.log('Data formulario\n')

		this._peticiones.hasBeenTouchedBuscador = true

		this._peticiones.buscadorForm(this.formularioBuscador.value).subscribe({
			next: data => {
				console.log('La data del buscador ha sido enviada correctamente\n' + JSON.stringify(data));
				if (data.body.data === 'Lo sentimos,no hemos encontrado ninguna ruta') {
					console.log('NO HAY NADA');
				} else {
					console.log('DATA:\n');
					console.log(data.body.data);
					// Tiene que ser un Array<Ruta> el data.body...
					this._peticiones.setResponse(data.body.data)
					this.route.navigate(['/tipo-ruta'])
				}
			},
			error: error => {
				console.log('Ha habido un error a la hora de enviar los datos a través del buscador\n' + error);
				console.log(this.formularioBuscador.value);
			}
		})
	}
}
