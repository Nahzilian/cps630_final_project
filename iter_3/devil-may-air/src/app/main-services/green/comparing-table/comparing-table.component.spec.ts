import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ComparingTableComponent } from './comparing-table.component';

describe('ComparingTableComponent', () => {
  let component: ComparingTableComponent;
  let fixture: ComponentFixture<ComparingTableComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ComparingTableComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(ComparingTableComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
