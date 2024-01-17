import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './components/home/home.component';
import { CheckComponent } from './components/check/check.component';
import { CreaRutaComponent } from './components/crea-ruta/crea-ruta.component';
import { ContactoComponent } from './components/contacto/contacto.component';
import { TipoRutaComponent } from './components/tipo-ruta/tipo-ruta.component';
import { InfoRutaComponent } from './components/info-ruta/info-ruta.component';
import { LoginComponent } from './components/login/login.component';
import { CreateAccComponent } from './components/create-acc/create-acc.component';
import { authGuard } from './guards/auth.guard';


const routes: Routes = [
	{ path: '', component: HomeComponent },
	{ path: 'info-ruta/:id', component: InfoRutaComponent },
	{ path: 'tipo-ruta', component: TipoRutaComponent },
	{ path: 'crearuta', component: CreaRutaComponent, canActivate: [authGuard] },
	{ path: 'contacto', component: ContactoComponent },
	{ path: 'check/:id', component: CheckComponent },
	{ path: 'login', component: LoginComponent },
	{ path: 'create_account', component: CreateAccComponent },
	{ path: '**', component: HomeComponent }
];

@NgModule({
	imports: [RouterModule.forRoot(routes)],
	exports: [RouterModule]
})
export class AppRoutingModule { }
