import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './components/home/home.component';
import { CheckComponent } from './components/check/check.component';
import { CreaRutaComponent } from './components/crea-ruta/crea-ruta.component';
import { FavoritasComponent } from './components/favoritas/favoritas.component';
import { ContactoComponent } from './components/contacto/contacto.component';
import { TipoRutaComponent } from './components/tipo-ruta/tipo-ruta.component';
import { InfoRutaComponent } from './components/info-ruta/info-ruta.component';
const routes: Routes = [
	{ path: '', component: HomeComponent },
	{ path: 'tipo-ruta', component: TipoRutaComponent },
	{ path: 'info-ruta', component: InfoRutaComponent },
	{ path: 'crearuta', component: CreaRutaComponent },
	{ path: 'favoritas', component: FavoritasComponent },
	{ path: 'contacto', component: ContactoComponent },
	{ path: 'check', component: CheckComponent },
	{ path: '**', component: HomeComponent }
];

@NgModule({
	imports: [RouterModule.forRoot(routes)],
	exports: [RouterModule]
})
export class AppRoutingModule { }
