import { Component, OnInit } from '@angular/core';
import Flower from 'src/models/flower';
import { CartService } from '../../utils/services/cart.service';

@Component({
  selector: 'app-my-cart',
  templateUrl: './my-cart.component.html',
  styleUrls: ['./my-cart.component.sass']
})
export class MyCartComponent implements OnInit {
  orderedFlower: Array<Flower>;
  panelOpenState = false;
  distance: number;
  travelingPrice: number;
  summary: number;
  source: string;
  destin: string;

  constructor(private cartService: CartService) {
    this.travelingPrice = 12;
    if (!this.orderedFlower) {
      let obj = this.cartService.getData()
      if(obj) {
        this.orderedFlower = obj.cart;
        this.source = obj.source;
        this.destin = obj.destin;
        console.log(this.source);
        console.log(this.destin);
        this.calculateDistance();
      }
    }
  }

  calculateDistance () {
    this.cartService.getDistance(this.source, this.destin, (res) => {
      this.distance = res;
    });
  }

  ngOnInit(): void { }

  updateQuantity(event, id) {
    let index = this.orderedFlower.findIndex(item => item.id === id);
    if(index > -1) {
      this.orderedFlower[index].quantity = event.target.value;
      return;
    }
  }

  getSummary() {
    let totalPrice = 0;
    console.log(this.distance)
    totalPrice += this.distance * this.travelingPrice;
    this.orderedFlower.forEach((elem) => {
      totalPrice += elem.price * elem.quantity;
    })
    this.summary = totalPrice;
    console.log(this.summary)
  }

  getFlowerImgSrc(id) {
    const max = 14
    if (id <= max) return `../../assets/img/flower/flower${id}.jpeg`;
    return '../../assets/img/flower/plc.jpeg';
  }
}
