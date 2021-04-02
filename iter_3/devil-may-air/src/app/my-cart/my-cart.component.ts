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
  constructor() {
    if (localStorage.getItem('items'))
      this.orderedFlower = JSON.parse(localStorage.getItem('items'));
  }

  ngOnInit(): void {
  }

  ngAfterViewChecked(): void {
    if (localStorage.getItem('items'))
    this.orderedFlower = JSON.parse(localStorage.getItem('items'));
  }

  getFlowerImgSrc(id) {
    const max = 5
    if (id <= max) return `../../assets/img/flower/flower${id}.jpeg`;
    return '../../assets/img/flower/plc.jpeg';
  }
}
