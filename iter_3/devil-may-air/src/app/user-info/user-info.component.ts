import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { Router } from '@angular/router';
import { logout } from '../../utils/api/apiController';
import axios from 'axios';

@Component({
  selector: 'app-user-info',
  templateUrl: './user-info.component.html',
  styleUrls: ['./user-info.component.sass']
})
export class UserInfoComponent implements OnInit {
  userForm: FormGroup;
  balance: number;
  error: string;

  constructor(private router: Router) {
    this.loadUser();
  }

  toggleError () {
    this.error = '';
  }
  saveChanges() {
      const data = {
        name: this.userForm.controls['name'].value,
        address: this.userForm.controls['address'].value,
        cityCode: this.userForm.controls['cityCode'].value,
        email: this.userForm.controls['email'].value,
        phone: this.userForm.controls['phone'].value,
      }
      this.editUserInfo(data);
  }

  loadUser() {
    this.userForm = new FormGroup({
      name: new FormControl(''),
      address: new FormControl(''),
      cityCode: new FormControl(''),
      email: new FormControl(''),
      phone: new FormControl(''),
    });
    this.loadUserInfo()
  }

  async loadUserInfo() {
    // Since there's only 1 tester, this will directly call API
      let user = await this.getPersonalInfo();
      this.userForm.patchValue({
        name: user.name,
        address: user.address,
        cityCode: user.cityCode,
        email: user.email,
        phone: user.phone,
      })
      this.balance = user.balance;
  }


  editUserInfo(data) {
    let user = JSON.parse(localStorage.getItem('user'))
    const token = JSON.parse(localStorage.getItem('token'))
    axios.put(`/user/me/update/${user.id}`, data, {headers: {'x-auth-token': token}}).then(res => {
      if(res.status === 201) {
        Object.assign(user, data);
        localStorage.setItem('user', JSON.stringify(user));
      };
    }).catch(err => {this.error = err});
  }

  async getPersonalInfo() {
    let token = JSON.parse(localStorage.getItem('token'));
    let userId = JSON.parse(localStorage.getItem('user')).id;
    const result = await axios.get(`/user/me/${userId}`, {headers: {'x-auth-token': token}}).catch(err => this.error = err);
    return result.data;
  }

  logout() {
    logout();
    this.router.navigate(['/']);
  }

  ngOnInit(): void {
  }

}
