import { Component, OnInit } from '@angular/core';
import Flower from 'src/models/flower';

@Component({
  selector: 'app-main-services',
  templateUrl: './main-services.component.html',
  styleUrls: ['./main-services.component.sass']
})
export class MainServicesComponent implements OnInit {
  ordered: boolean;
  customerOrder: Object;

  constructor() {
    this.ordered = false;
  }
  addFlowerOrder(newOrder: Object) {
    this.ordered = true;
    this.customerOrder = newOrder;
    console.log(newOrder);
  }

  ngOnInit(): void {
  }

}
