import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CreaRutaComponent } from './crea-ruta.component';

describe('CreaRutaComponent', () => {
  let component: CreaRutaComponent;
  let fixture: ComponentFixture<CreaRutaComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [CreaRutaComponent]
    });
    fixture = TestBed.createComponent(CreaRutaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
