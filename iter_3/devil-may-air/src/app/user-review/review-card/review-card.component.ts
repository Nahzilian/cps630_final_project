import { Component, OnInit, HostListener, Input } from '@angular/core';
import { getAllCar } from '../../../utils/api/publicAPI';

import Car from '../../../models/car';
import Flower from 'src/models/flower';

import { getAllFlower } from '../../../utils/api/publicAPI';

import { sendReview } from '../../../utils/api/apiController';

@Component({
  selector: 'app-review-card',
  templateUrl: './review-card.component.html',
  styleUrls: ['./review-card.component.sass']
})
export class ReviewCardComponent implements OnInit {
  @Input() title: string;
  @Input() subtitle: string;
  @Input() description: string;

  select_img_size: number;
  allCar: Array<Car>;
  allFlower: Array<Flower>;

  innerWidth: any;
  widthFactor: number;
  like: boolean;
  dislike: boolean;
  stars: number;

  check = false;
  constructor() {
    this.select_img_size = 35;
    this.widthFactor = 15;
    this.like = false;
    this.dislike = false;
    this.stars = 0;
  }

  review(like: string){
    if (like === 'like') {
      this.like = true;
      if(!this.check)
        this.stars++;
      if(this.check && this.dislike)
        this.stars+=2;
      this.check = true;
      this.dislike = false;
    }else if (like === 'dislike') {
      this.dislike = true;
      if(!this.check)
        this.stars--;
      if(this.check && this.like)
      this.stars-=2;
      this.check = true;
      this.like = false;
    }
  }

  async getCars(){
    let tempCar = await getAllCar(0, 100);
    this.allCar = tempCar.data.data;
  }

  async getFlowers() {
    let tempCar = await getAllFlower(0, 100);
    this.allFlower = tempCar.data.data;
  }

  getCarImgSrc(id) {
    const max = 5
    if (id <= max) return `../../../assets/img/car/car${id}.jpeg`;
    return '../../../assets/img/car/plc.jpeg';
  }

  getFlowerImgSrc(id) {
    const max = 5
    if (id <= max) return `../../../assets/img/flower/flower${id}.jpeg`;
    return '../../../assets/img/flower/plc.jpeg';
  }

  @HostListener('window:resize', ['$event'])
  onResize(event) {

    this.innerWidth = window.innerWidth;
  }

  submit(comment, productName){
    let obj = {
      review: comment,
      score: this.stars,
      type: this.title,
      itemId: productName
    };

    sendReview(obj);
  }

  ngOnInit(): void {
    if(this.title === 'Driver')
      this.getCars();
    else if(this.title === 'Flower')
      this.getFlowers();
  }

}
