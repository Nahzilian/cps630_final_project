import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AutocompleteAddressComponent } from './autocomplete-address.component';

describe('AutocompleteAddressComponent', () => {
  let component: AutocompleteAddressComponent;
  let fixture: ComponentFixture<AutocompleteAddressComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ AutocompleteAddressComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(AutocompleteAddressComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
