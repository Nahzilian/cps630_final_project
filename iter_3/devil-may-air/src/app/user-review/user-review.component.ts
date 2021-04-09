import { Component, OnInit } from '@angular/core';
import { getAllCar } from '../../utils/api/publicAPI';

import Car from '../../models/car';

@Component({
  selector: 'app-user-review',
  templateUrl: './user-review.component.html',
  styleUrls: ['./user-review.component.sass']
})
export class UserReviewComponent implements OnInit {
  select_img_size: number;
  allCar: Array<Car>;

  constructor() {
    this.select_img_size = 35;
    this.getCars();
  }

  async getCars(){
    let tempCar = await getAllCar(0, 100);
    this.allCar = tempCar.data.data;
  }

  getCarImgSrc(id) {
    const max = 5
    if (id <= max) return `../../../assets/img/car/car${id}.jpeg`;
    return '../../../assets/img/car/plc.jpeg';
  }

  ngOnInit(): void {

  }

}
