import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { login } from '../../utils/api/apiController';

import axios from 'axios';

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
  data: String;
  error: String;
  constructor() {
  }

  ngOnInit(): void {
    axios.get('/').then(res => this.data = res.data.msg)
  }
  submit() {
    if (this.form.valid) {
      try {
        login(this.form.controls['username'].value, this.form.controls['password'].value);
        console.log('Here')
      } catch (err){
        this.error = err
      }
    }
  }
}
