import { Component, OnInit, AfterViewChecked, Input } from '@angular/core';
import Flower from 'src/models/flower';
import { CartService } from '../../utils/services/cart.service';

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



  constructor(private cartService: CartService) {
    this.travelingPrice = 12;
    if (!this.customerOrder) {
      let obj = this.cartService.getData()
      this.orderedFlower = obj.cart;
    }
  }

  ngOnInit(): void { }

  ngAfterViewChecked(): void {
    if (!this.customerOrder) {
      let obj = this.cartService.getData()
      this.orderedFlower = obj.cart;
    }
  }

  getSummary() {
    let totalPrice = 0;
    totalPrice += this.distance * this.travelingPrice;
    this.orderedFlower.forEach((elem) => {
      totalPrice += elem.price;
    })
  }

  getFlowerImgSrc(id) {
    const max = 14
    if (id <= max) return `../../assets/img/flower/flower${id}.jpeg`;
    return '../../assets/img/flower/plc.jpeg';
  }
}
