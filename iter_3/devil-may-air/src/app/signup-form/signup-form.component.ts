import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { Router } from "@angular/router";
import { register } from '../../utils/api/apiController';

@Component({
  selector: 'app-signup-form',
  templateUrl: './signup-form.component.html',
  styleUrls: ['./signup-form.component.sass']
})
export class SignupFormComponent implements OnInit {
  error: String;
  form: FormGroup = new FormGroup({
    name: new FormControl(''),
    email: new FormControl(''),
    phone: new FormControl(''),
    address: new FormControl(''),
    cityCode: new FormControl(''),
    username: new FormControl(''),
    password: new FormControl(''),
    creditCard: new FormControl('')
  });
  constructor(private router: Router) {
    this.error = '';
  }

  ngOnInit(): void {

  }

  submit() {
    if (this.form.valid) {
      try {
        register(this.form.controls);
        this.router.navigate(['/']);
      } catch (err) {
        this.error = err
      }
    }
  }
}
