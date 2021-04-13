import { Component, OnInit } from '@angular/core';
import Flower from 'src/models/flower';
import { CartService } from '../../utils/services/cart.service';
import { checkout } from '../../utils/api/apiController';
import { getAvailableCar } from '../../utils/api/publicAPI';

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

  async getSummary() {
    let totalPrice = 0;
    console.log(this.distance)
    let tripPrice = this.distance * this.travelingPrice;
    totalPrice += tripPrice;

    this.orderedFlower.forEach((elem) => {
      totalPrice += elem.price * elem.quantity;
    })
    this.summary = parseFloat(totalPrice.toFixed(2));

    let availableCar = await getAvailableCar();
    const user = JSON.parse(localStorage.getItem('user'))
    console.log(availableCar);
    let obj = {
        source: this.source,
        destination: this.destin,
        distance: this.distance,
        carId: availableCar[0]._id,
        price: tripPrice,
        totalPrice: this.summary,
        customerId: user.id,
        flowers: this.orderedFlower
    }
    console.log(obj)
    checkout(obj);
  }

  getFlowerImgSrc(id) {
    const max = 14
    if (id <= max) return `../../assets/img/flower/flower${id}.jpeg`;
    return '../../assets/img/flower/plc.jpeg';
  }
}
