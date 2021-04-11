import { Component, Input, OnInit } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { register } from 'src/utils/api/apiController';

@Component({
  selector: 'app-create-form',
  templateUrl: './create-form.component.html',
  styleUrls: ['./create-form.component.sass']
})
export class CreateFormComponent implements OnInit {
  error: String;
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
    
  })

  submitUser() {
    if (this.userForm.valid) {
      try {
        register(this.userForm.controls);
      } catch (err) {
        this.error = err
      }
    }
  }


  constructor() { }

  ngOnInit(): void {
  }

}
