import { Component, OnInit } from '@angular/core';
import Flower from 'src/models/flower';
import { CartService } from '../../utils/services/cart.service';
import { checkout } from '../../utils/api/apiController';
import { getAvailableCar } from '../../utils/api/publicAPI';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-my-cart',
  templateUrl: './my-cart.component.html',
  styleUrls: ['./my-cart.component.sass']
})
export class MyCartComponent implements OnInit {
  orderedFlower: Array<Flower> = [];
  orderedDriver: any;
  panelOpenState = false;
  distance: number;
  travelingPrice: number;
  summary: number;
  source: string;
  destin: string;
  typeOfService: string;

  constructor(private cartService: CartService, private route: ActivatedRoute) {
    this.travelingPrice = 12;
    this.typeOfService = this.route.snapshot.paramMap.get('type');
    if (this.orderedFlower.length === 0 || !this.orderedDriver ) {
      let obj = this.cartService.getData()
      console.log(obj)
      if(obj) {
        if (this.typeOfService === 'flower') this.orderedFlower = obj.cart;
        if (this.typeOfService === 'driver') this.orderedDriver = obj.cart;
        this.source = obj.source;
        this.destin = obj.destin;
        this.calculateDistance();
      }
    }
    console.log(this.orderedDriver)
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

    let tripPrice = this.distance * this.travelingPrice;
    totalPrice += tripPrice;
    let availableCar;
    if(this.typeOfService === 'flower') {
      this.orderedFlower.forEach((elem) => {
        totalPrice += elem.price * elem.quantity;
      })
      availableCar = await getAvailableCar();
    }

    this.summary = parseFloat(totalPrice.toFixed(2));

    const user = JSON.parse(localStorage.getItem('user'))

    let obj = {
        source: this.source,
        destination: this.destin,
        distance: this.distance,
        carId: availableCar? availableCar[0]._id : this.orderedDriver._id,
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

  getCarImgSrc(id) {
    const max = 5
    if (id <= max) return `../../assets/img/car/car${id}.jpeg`;
    return '../../assets/img/car/plc.jpeg';
  }

  cancelDrive() {
    this.orderedDriver = null;
  }

  removeFlower (flowerId) {
    this.orderedFlower = this.orderedFlower.filter(x => x.id !== flowerId)
  }

}
