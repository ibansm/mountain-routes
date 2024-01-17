import { Component, Input, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-vertical-card',
  templateUrl: './vertical-card.component.html',
  styleUrls: ['./vertical-card.component.scss']
})
export class VerticalCardComponent implements OnInit {

	@Input() datosPadre: Array<any> = [];

	constructor( 
		private router: Router
	) {}

	ngOnInit(): void {
	}

	public clickCard(id: any) : void {
		this.router.navigate(['info-ruta/' + id])
	}
}
