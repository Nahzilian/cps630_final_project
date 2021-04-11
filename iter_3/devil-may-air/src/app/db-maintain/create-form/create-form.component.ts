import { Component, Input, OnInit } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { register, addCar } from 'src/utils/api/apiController';

@Component({
  selector: 'app-create-form',
  templateUrl: './create-form.component.html',
  styleUrls: ['./create-form.component.sass']
})
export class CreateFormComponent implements OnInit {
  error = '';
  @Input() formType: String;
  userForm: FormGroup = new FormGroup({
    name: new FormControl(''),
    email: new FormControl(''),
    phone: new FormControl(''),
    address: new FormControl(''),
    cityCode: new FormControl(''),
    username: new FormControl(''),
    password: new FormControl(''),
    creditCard: new FormControl('')
  });

  carForm: FormGroup = new FormGroup({
    model : new FormControl(''),
    carCode : new FormControl(''),
    imageid : new FormControl(''),
    available: new FormControl('')
  })

  flowerForm: FormGroup = new FormGroup({
    price : new FormControl(''),
    flowerName : new FormControl(''),
    storeCode: new FormControl(''),
    imageid: new FormControl(''),
    quantity: new FormControl('')
  })

  submitCar() {
    if (this.carForm.valid) {
      try {
        addCar(this.carForm.controls);
      } catch (err) {
        this.error = err
      }
    }
  }

  submitUser() {
    if (this.userForm.valid) {
      try {
        register(this.userForm.controls);
      } catch (err) {
        this.error = err
      }
    }
  }

  submitFlower() {
    
  }


  constructor() { }

  ngOnInit(): void {
  }

}
