import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { Router } from "@angular/router";
import { login } from '../../utils/api/apiController';

@Component({
  selector: 'app-login-form',
  templateUrl: './login-form.component.html',
  styleUrls: ['./login-form.component.sass']
})
export class LoginFormComponent implements OnInit {
  form: FormGroup = new FormGroup({
    username: new FormControl(''),
    password: new FormControl(''),
  });
  error: String;
  constructor(private router: Router) {

  }

  ngOnInit(): void {
  }
  submit() {
    if (this.form.valid) {
      try {
        login(this.form.controls['username'].value, this.form.controls['password'].value);
        this.router.navigate(['/']);
      } catch (err){
        this.error = err
      }
    }
  }
}
