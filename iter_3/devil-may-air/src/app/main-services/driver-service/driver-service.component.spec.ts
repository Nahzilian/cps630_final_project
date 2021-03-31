import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DriverServiceComponent } from './driver-service.component';

describe('DriverServiceComponent', () => {
  let component: DriverServiceComponent;
  let fixture: ComponentFixture<DriverServiceComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ DriverServiceComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(DriverServiceComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
