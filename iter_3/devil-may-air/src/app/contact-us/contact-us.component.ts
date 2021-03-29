import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';

@Component({
  selector: 'app-contact-us',
  templateUrl: './contact-us.component.html',
  styleUrls: ['./contact-us.component.sass']
})
export class ContactUsComponent implements OnInit {

  mailSent: boolean

  form: FormGroup = new FormGroup({
    subject: new FormControl(''),
    email: new FormControl(''),
    message: new FormControl(''),
  });
  constructor() {
    this.mailSent = false;
  }

  ngOnInit(): void {

  }

  submit () {
    this.mailSent = true;
  }

}
