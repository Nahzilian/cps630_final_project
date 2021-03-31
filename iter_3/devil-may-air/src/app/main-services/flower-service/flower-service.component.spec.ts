import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FlowerServiceComponent } from './flower-service.component';

describe('FlowerServiceComponent', () => {
  let component: FlowerServiceComponent;
  let fixture: ComponentFixture<FlowerServiceComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ FlowerServiceComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(FlowerServiceComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
