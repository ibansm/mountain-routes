import { AfterViewInit, Component, OnInit } from '@angular/core';
import { PeticionesService } from 'src/app/service/peticiones.service';
import { ActivatedRoute  } from '@angular/router';
import { Location } from '@angular/common';
import { Map, tileLayer, LatLng } from 'leaflet';
import * as L from 'leaflet';

@Component({
  selector: 'app-info-ruta',
  templateUrl: './info-ruta.component.html',
  styleUrls: ['./info-ruta.component.scss'],
})
export class InfoRutaComponent implements OnInit, AfterViewInit {
	constructor( private _peticiones: PeticionesService, private route: ActivatedRoute, private location: Location ) {}
	
	public ruta: any;
	public fotosAll: any[] = []
	public currentURL: string = this.location.path();

	public unaCoorr: any[] = []
	public todasCoor: any[] = []
	public coordenadas: any[] = []

	//public urlTree = this.urlSerializer.parse(this.currentURL);
	public id : string = "";

	ngOnInit(): void {
		console.log('Current URL:-> ', this.currentURL);
		//console.log('Parsed URL Tree:', this.urlTree);
		this.route.params.subscribe(params => {
			this.id = params['id'];
			console.log('Route Parameter - ID:', this.id);
		  });
		this.getRuta();
		this.getFotos();
		this.coordenadas = this.ruta.coordenadas;
		console.log('Resultado de mis coordenadas: \n', this.coordenadas);
		//this.getCoordenadas();
	}

	ngAfterViewInit(): void {

		for (const coordinate of this.coordenadas) {
			this.unaCoorr.push(parseFloat(coordinate.lat));
			this.unaCoorr.push(parseFloat(coordinate.lng));
			this.todasCoor.push(this.unaCoorr);
			this.unaCoorr = [];
		}

		const map = new Map('map').setView(this.todasCoor[0], 15);

		tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

	}

	public getRuta() {
		this._peticiones.getRuta(parseInt(this.id, 10)).subscribe({
			
			next: data => {
				this.ruta = data.data
				console.log('Resultado de getRutas: \n', this.ruta);
			},
			error: error => {
				console.log('Error accessing cities data\nERROR: ', error);
				this.ruta = []
			}
		})
	}
	public getFotos() {
		this._peticiones.getFotos(parseInt(this.id, 10)).subscribe({
			
			next: data => {
				this.fotosAll = Object.values(data.data)
				this.fotosAll.pop()
				console.log('Resultado de getFoto: \n', this.fotosAll);
			},
			error: error => {
				console.log('Error accessing cities data\nERROR: ', error);
				this.fotosAll = []
			}
		})
	}
	//public getCoordenadas() {
	//	this._peticiones.getGeojson(parseInt(this.id, 10)).subscribe({
	//		
	//		next: data => {
	//			this.coordenadas = Object.values(data.data)
	//			console.log('Resultado de getCoordenadas: \n', this.coordenadas);
	//		},
	//		error: error => {
	//			console.log('Error accessing cities data\nERROR: ', error);
	//			this.fotosAll = []
	//		}
	//	})
	//}
}
