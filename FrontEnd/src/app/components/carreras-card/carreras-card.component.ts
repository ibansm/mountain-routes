import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-carreras-card',
  templateUrl: './carreras-card.component.html',
  styleUrls: ['./carreras-card.component.scss']
})
export class CarrerasCardComponent implements OnInit {
	@Input() datosPadre: Array<any> = [];

	constructor( 
	) {}

	ngOnInit(): void {
	}

	public clickCard(web: string) : void {
		open(web)
	}
}
