import { Component, Input, OnInit } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';

@Component({
  selector: 'app-update-form',
  templateUrl: './update-form.component.html',
  styleUrls: ['./update-form.component.sass']
})
export class UpdateFormComponent implements OnInit {
  error = '';
  @Input() formType: String;
  @Input() data: any;
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
    model: new FormControl(''),
    carCode: new FormControl(''),
    imageid: new FormControl(''),
    available: new FormControl('')
  })

  flowerForm: FormGroup = new FormGroup({
    price: new FormControl(''),
    flowerName: new FormControl(''),
    storeCode: new FormControl(''),
    imageid: new FormControl(''),
    quantity: new FormControl('')
  })

  tripForm: FormGroup = new FormGroup({
    source: new FormControl(''),
    destination: new FormControl(''),
    distance: new FormControl(''),
    carId: new FormControl(''),
    price: new FormControl(''),
  })

  orderForm: FormGroup = new FormGroup({
    dateDone: new FormControl(''),
    dateIssued: new FormControl(''),
  });

  reviewForm: FormGroup = new FormGroup({
    review: new FormControl(''),
    score: new FormControl(''),
    type: new FormControl(''),
  })

  constructor() { }

  submitCar() {
    if (this.carForm.valid) {
      try {
        // addCar(this.carForm.controls);
      } catch (err) {
        this.error = err
      }
    }
  }

  submitUser() {
    if (this.userForm.valid) {
      try {
        // register(this.userForm.controls);
      } catch (err) {
        this.error = err
      }
    }
  }

  submitFlower() {

  }

  submitTrip() {

  }

  submitOrder() {

  }

  ngOnInit(): void {
  }

}
