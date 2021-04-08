import { ThrowStmt } from '@angular/compiler';
import { Component, OnInit, AfterViewChecked, Input } from '@angular/core';
import Flower from 'src/models/flower';

@Component({
  selector: 'app-my-cart',
  templateUrl: './my-cart.component.html',
  styleUrls: ['./my-cart.component.sass']
})
export class MyCartComponent implements OnInit, AfterViewChecked {

  @Input() customerOrder: any;
  orderedFlower: Array<Flower>;
  panelOpenState = false;
  distance: number;
  travelingPrice: number;



  constructor() {
    this.travelingPrice = 12;
    if (this.customerOrder){
      let cart = this.customerOrder.cart;
      this.orderedFlower = cart;
    }
  }

  ngOnInit(): void {}

  ngAfterViewChecked(): void {
    if (this.customerOrder){
      this.orderedFlower = this.customerOrder.cart;
      this.distance = this.customerOrder.distance;
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
