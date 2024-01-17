import { Component, OnInit } from '@angular/core';
import { PeticionesService } from 'src/app/service/peticiones.service';
import { Location } from '@angular/common';
import { Router  } from '@angular/router';


@Component({
  selector: 'app-create-acc',
  templateUrl: './create-acc.component.html',
  styleUrls: ['./create-acc.component.scss']
})
export class CreateAccComponent {
  usuario = {
    username: '',
    email: '',
    password: ''
  };

  constructor(private _peticiones: PeticionesService, private router: Router) { }

  crearCuenta() {
    // Aquí puedes acceder a los datos del formulario a través de this.usuario
    console.log('Datos del usuario:', this.usuario);

	// Recuperamos el user_id
	this._peticiones.getUserId(this.usuario.email).subscribe({
		next: data => {
			console.log('USER_ID\n')
			console.log(data.data[0].id)
			localStorage.setItem('user_id', JSON.stringify(data.data[0].id))
		},
		error: error => { console.log('Error a la hora de recuperar el user_id ' + error)}
	})

    // También puedes acceder a los controles del formulario
    console.log(localStorage.getItem("token"));
    this._peticiones.postRegistrarse(this.usuario).subscribe({
          next: data => {
            localStorage.setItem("access_token", JSON.stringify(data.data.access_token));
            localStorage.setItem("token_type", JSON.stringify(data.data.token_type));
			this._peticiones.isLogged = true
            this.router.navigate(['/home']);
            console.log('Datos del usuario1:', data)
          },
          error: error => {
            console.log('Error a la hora de guardar la ruta.\n' + error);
          }
    })
  }
}

