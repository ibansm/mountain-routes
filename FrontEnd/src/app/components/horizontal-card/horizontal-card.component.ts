import { Component, Input } from '@angular/core';
import { Ruta } from 'src/app/models/ruta';

@Component({
  selector: 'app-horizontal-card',
  templateUrl: './horizontal-card.component.html',
  styleUrls: ['./horizontal-card.component.scss'],
  providers: []
})
export class HorizontalCardComponent {

	@Input() datosPadre: Array<Ruta> = []
	
}
