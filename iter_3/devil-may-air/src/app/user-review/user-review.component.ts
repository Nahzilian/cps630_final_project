import { Component, OnInit, HostListener } from '@angular/core';
import { getAllCar } from '../../utils/api/publicAPI';

import {FormControl} from '@angular/forms';
import Car from '../../models/car';

@Component({
  selector: 'app-user-review',
  templateUrl: './user-review.component.html',
  styleUrls: ['./user-review.component.sass']
})
export class UserReviewComponent implements OnInit {

  toggleControl = new FormControl('driver');

  constructor() {

  }

  ngOnInit(): void {

  }

}
