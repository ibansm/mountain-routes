import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HomeComponent } from './components/home/home.component';
import { MenuComponent } from './components/menu/menu.component';
import { CheckComponent } from './components/check/check.component';
import { ContactoComponent } from './components/contacto/contacto.component';
import { FavoritasComponent } from './components/favoritas/favoritas.component';
import { CreaRutaComponent } from './components/crea-ruta/crea-ruta.component';
import { TipoRutaComponent } from './components/tipo-ruta/tipo-ruta.component';

@NgModule({
	declarations: [
		AppComponent,
		HomeComponent,
		MenuComponent,
		CheckComponent,
		ContactoComponent,
		FavoritasComponent,
		CreaRutaComponent,
  TipoRutaComponent,
	],
	imports: [
		BrowserModule,
		AppRoutingModule
	],
	providers: [],
	bootstrap: [AppComponent]
})
export class AppModule { }
