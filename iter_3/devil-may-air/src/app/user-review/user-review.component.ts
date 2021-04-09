import { Component, OnInit } from '@angular/core';
import { getAllCar } from '../../utils/api/publicAPI';

@Component({
  selector: 'app-user-review',
  templateUrl: './user-review.component.html',
  styleUrls: ['./user-review.component.sass']
})
export class UserReviewComponent implements OnInit {
  select_img_size: number;
  constructor() {
    this.select_img_size = 35;
  }

  ngOnInit(): void {

  }

}
