import { ComponentFixture, TestBed } from '@angular/core/testing';

import { InfoRutaComponent } from './info-ruta.component';

describe('InfoRutaComponent', () => {
  let component: InfoRutaComponent;
  let fixture: ComponentFixture<InfoRutaComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [InfoRutaComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(InfoRutaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
