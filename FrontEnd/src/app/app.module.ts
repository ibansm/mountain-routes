import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { AppRoutingModule } from './app-routing.module';

import { LeafletModule } from '@asymmetrik/ngx-leaflet';

// Components
import { AppComponent } from './app.component';
import { HomeComponent } from './components/home/home.component';
import { MenuComponent } from './components/menu/menu.component';
import { CheckComponent } from './components/check/check.component';
import { ContactoComponent } from './components/contacto/contacto.component';
import { CreaRutaComponent } from './components/crea-ruta/crea-ruta.component';
import { TipoRutaComponent } from './components/tipo-ruta/tipo-ruta.component';
import { InfoRutaComponent } from './components/info-ruta/info-ruta.component';
import { BuscadorComponent } from './components/buscador/buscador.component';
import { HorizontalCardComponent } from './components/horizontal-card/horizontal-card.component';
import { FooterComponent } from './components/footer/footer.component';
import { VerticalCardComponent } from './components/vertical-card/vertical-card.component';
import { CreateAccComponent } from './components/create-acc/create-acc.component';
import { LoginComponent } from './components/login/login.component';

@NgModule({
	declarations: [
		AppComponent,
		HomeComponent,
		MenuComponent,
		CheckComponent,
		CreateAccComponent,
		ContactoComponent,
		CreaRutaComponent,
		LoginComponent,
		InfoRutaComponent,
		TipoRutaComponent,
		BuscadorComponent,
		HorizontalCardComponent,
		FooterComponent,
  		VerticalCardComponent
	],
	imports: [
		BrowserModule,
		AppRoutingModule,
		HttpClientModule,
		FormsModule,
		LeafletModule,
		ReactiveFormsModule
	],
	providers: [],
	bootstrap: [AppComponent]
})
export class AppModule { }
