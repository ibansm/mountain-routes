import { Component, OnInit } from '@angular/core';
import { PeticionesService } from 'src/app/service/peticiones.service';
import { Injectable } from '@angular/core';
import { Router  } from '@angular/router';
import { Location } from '@angular/common';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent {
  usuario = {
    email: '',
    password: ''
  };

  constructor(private _peticiones: PeticionesService, private router: Router ) { }

  login(formulario: any) {
    // Aquí puedes acceder a los datos del formulario a través de this.usuario
    console.log('Datos del usuario:', this.usuario);

    // También puedes acceder a los controles del formulario
    console.log('Controles del formulario:', formulario.controls);
    this._peticiones.postLogin(this.usuario).subscribe({
			next: data => {
        localStorage.setItem("access_token", JSON.stringify(data.access_token));
        localStorage.setItem("token_type", JSON.stringify(data.token_type));
        this.router.navigate(['/ruta-destino']);
				console.log('Datos del usuario1:', data)
			},
			error: error => {
				console.log('Error a la hora de guardar la ruta.\n' + error);
			}
		})
  }
}
