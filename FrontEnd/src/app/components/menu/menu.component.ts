import { Component } from '@angular/core';

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html',
  styleUrls: ['./menu.component.scss']
})
export class MenuComponent {
	
	toggle() : void {
		document.querySelector('#navbarNav')?.classList.toggle('collapse');
	}
}
