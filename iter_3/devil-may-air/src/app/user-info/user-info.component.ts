import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { Router } from '@angular/router';
import { editUserInfo, logout } from '../../utils/api/apiController'

@Component({
  selector: 'app-user-info',
  templateUrl: './user-info.component.html',
  styleUrls: ['./user-info.component.sass']
})
export class UserInfoComponent implements OnInit {
  form: FormGroup;
  balance: number;

  constructor(private router: Router) {
    this.loadUserInfo()
  }

  saveChanges () {
    const data = {
      name: this.form.controls['name'].value,
      address: this.form.controls['address'].value,
      cityCode: this.form.controls['cityCode'].value,
      email: this.form.controls['email'].value,
      phone: this.form.controls['phone'].value,
    }
    editUserInfo(data);
  }

  loadUserInfo () {
    let user = JSON.parse(localStorage.getItem('user'));
    this.form = new FormGroup({
      name: new FormControl(user.name),
      address: new FormControl(user.address),
      cityCode: new FormControl(user.cityCode),
      email: new FormControl(user.email),
      phone: new FormControl(user.phone),
    });
    this.balance = user.balance;
  }

  logout() {
    logout();
    this.router.navigate(['/']);
  }

  ngOnInit(): void {
  }

}
