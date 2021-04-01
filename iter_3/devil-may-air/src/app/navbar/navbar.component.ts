import { Component, AfterViewChecked } from '@angular/core';
import User from '../../models/user';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.sass']
})

export class NavbarComponent implements AfterViewChecked {
  navbarOpen = false;
  userAccount: User;
  isAdmin: boolean;

  refreshed = false;
  constructor() {}
  ngAfterViewChecked(): void {
    // This is to resolve NG0100 error and to update the UI properly
    // Video of explaination: https://angular.io/errors/NG0100
    setTimeout(() => {
      if(localStorage.getItem('user')) {
        this.userAccount = JSON.parse(localStorage.getItem('user')) || null;
        this.isAdmin = this.userAccount? this.userAccount.isAdmin :false;
      } else {
        this.userAccount = null;
        this.isAdmin = false;
      }
    }, 0)
  }

}
