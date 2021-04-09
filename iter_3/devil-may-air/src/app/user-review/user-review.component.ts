import { Component, OnInit, HostListener } from '@angular/core';
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
  innerWidth: any;
  widthFactor: number;
  like: boolean;
  dislike: boolean;

  constructor() {
    this.select_img_size = 35;
    this.widthFactor = 15;
    this.getCars();
    this.like = false;
    this.dislike = false;
  }

  review(like: string){
    if (like === 'like') {
      this.like = true;
      this.dislike = false;
    }else if (like === 'dislike') {
      this.dislike = true;
      this.like = false;
    }
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

  @HostListener('window:resize', ['$event'])
  onResize(event) {

    this.innerWidth = window.innerWidth;
  }

  ngOnInit(): void {

  }

}
