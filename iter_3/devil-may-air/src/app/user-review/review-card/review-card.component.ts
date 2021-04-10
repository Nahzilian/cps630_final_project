import { Component, OnInit, HostListener, Input } from '@angular/core';
import { getAllCar, getAllFlower, findReview   } from '../../../utils/api/publicAPI';

import Car from '../../../models/car';
import Flower from 'src/models/flower';
import Review from 'src/models/review';


import { sendReview } from '../../../utils/api/apiController';
import {
  MatSnackBar,
  MatSnackBarHorizontalPosition,
  MatSnackBarVerticalPosition,
} from '@angular/material/snack-bar';

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
  allReviews: Array<any>;

  innerWidth: any;
  widthFactor: number;
  like: boolean;
  dislike: boolean;
  stars: number;
  score: number;
  og_score: number;
  numberOfReviews: number;

  check = false;

  horizontalPosition: MatSnackBarHorizontalPosition = 'center';
  verticalPosition: MatSnackBarVerticalPosition = 'top';
  duration: number = 700;
  constructor(private _snackBar: MatSnackBar) {
    this.select_img_size = 35;
    this.widthFactor = 15;
    this.like = false;
    this.dislike = false;
    this.stars = 0;
    this.score = 0;
  }

  review(like: string){
    if(!this.check){
      this.numberOfReviews++;
    }
    if (like === 'like') {
      this.like = true;
      if(!this.check)
        this.stars++;
      if(this.check && this.dislike){
        this.stars+=2;
      }
      this.check = true;
      this.dislike = false;
    }else if (like === 'dislike') {
      this.dislike = true;
      if(!this.check)
        this.stars--;
      if(this.check && this.like){
        this.stars-=2;

      }
      this.check = true;
      this.like = false;
    }
    this.score = this.stars + this.og_score<0?0:this.og_score + this.stars;

  }

  async getCars(){
    let tempCar = await getAllCar(0, 100);
    this.allCar = tempCar.data.data;
  }

  async getFlowers() {
    let tempCar = await getAllFlower(0, 100);
    this.allFlower = tempCar.data.data;
  }

  async getReview(id){

    let reviews = await findReview(id);
    this.allReviews = reviews.data;
    this.numberOfReviews = this.allReviews.length;
    console.log(this.allReviews);
    let temp = 0;
    this.score = 0;
    this.allReviews.forEach(element => {
      temp += element.score;
    });
    this.score = temp;
    this.og_score = this.score;
    this.check = false;
    this.like = false;
    this.dislike = false;
    this.stars = 0;
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
    try {
      sendReview(obj);
        this._snackBar.open('Successfully Commented', 'Nice!!', {
        duration: this.duration,
        horizontalPosition: this.horizontalPosition,
        verticalPosition: this.verticalPosition,
      });
    } catch (err) {
      this._snackBar.open('Oooops Something Went Wrong', 'Noooooo!!', {
      duration: this.duration,
      horizontalPosition: this.horizontalPosition,
      verticalPosition: this.verticalPosition,
    });
    }
  }

  ngOnInit(): void {
    if(this.title === 'Driver')
      this.getCars();
    else if(this.title === 'Flower')
      this.getFlowers();
  }

}
