import { Component, OnInit, AfterViewChecked } from '@angular/core';
import Flower from 'src/models/flower';

@Component({
  selector: 'app-my-cart',
  templateUrl: './my-cart.component.html',
  styleUrls: ['./my-cart.component.sass']
})
export class MyCartComponent implements OnInit, AfterViewChecked {

  orderedFlower: Array<Flower>;
  panelOpenState = false;
  distance: number;
  travelingPrice: number;

  constructor() {
    this.travelingPrice = 12;
    if (localStorage.getItem('items'))
      this.orderedFlower = JSON.parse(localStorage.getItem('items'));
  }

  ngOnInit(): void {}

  ngAfterViewChecked(): void {
    let userOrder = localStorage.getItem('items');
    if (userOrder){
      let data = JSON.parse(userOrder);
      this.orderedFlower = data.cart;
      this.distance = data.distance;
    }
  }

  getSummary(){
    let totalPrice = 0;
    totalPrice += this.distance * this.travelingPrice;
    this.orderedFlower.forEach((elem) => {
      totalPrice += elem.price;
    })
  }

  getFlowerImgSrc(id) {
    const max = 5
    if (id <= max) return `../../assets/img/flower/flower${id}.jpeg`;
    return '../../assets/img/flower/plc.jpeg';
  }
}
