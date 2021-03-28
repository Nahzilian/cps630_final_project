import { Component, OnInit, AfterViewChecked } from '@angular/core';
import User from '../../models/user';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.sass']
})

export class NavbarComponent implements OnInit {
  navbarOpen = false;
  userAccount: User;
  isAdmin: boolean;

  refreshed = false;
  constructor() {
    this.userAccount = JSON.parse(localStorage.getItem('user')) || null;
    this.isAdmin = this.userAccount? this.userAccount.isAdmin :false;
  }

  ngOnInit(): void {}
  ngAfterViewChecked(): void {
    if(localStorage.getItem('user')) {
      this.userAccount = JSON.parse(localStorage.getItem('user')) || null;
      this.isAdmin = this.userAccount? this.userAccount.isAdmin :false;
    }
  }

}
