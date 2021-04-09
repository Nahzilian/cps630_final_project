import { CdkDragDrop, moveItemInArray, transferArrayItem } from '@angular/cdk/drag-drop';
import { Component, OnInit, ViewChild, OnChanges, Output, EventEmitter } from '@angular/core';
import { PageEvent } from '@angular/material/paginator';
import Flower from 'src/models/flower';
import { MapComponent } from '../map/map.component';
import { getAllFlower } from '../../../utils/api/publicAPI';
import { Router } from '@angular/router';

import { CartService } from '../../../utils/services/cart.service';

@Component({
  selector: 'app-flower-service',
  templateUrl: './flower-service.component.html',
  styleUrls: ['./flower-service.component.sass']
})
export class FlowerServiceComponent implements OnInit, OnChanges {
  @ViewChild(MapComponent) map!: MapComponent;

  @Output() newFlowerOrder = new EventEmitter<Object>();

  allFlower: Array<Flower>;
  cart: Array<Flower>;

  panelOpenState = false;

  length = 100;
  pageSize = 10;
  pageSizeOptions: number[] = [5, 10, 25, 100];

  // MatPaginator Output
  pageEvent: PageEvent;

  // Google map
  source: string;
  destin: string;
  error: string;

  // Drag drop
  itemCount: number

  drop(event: CdkDragDrop<string[]>) {
    setTimeout(() => {
      transferArrayItem(event.previousContainer.data,
        event.container.data,
        event.previousIndex,
        event.currentIndex);
    })
    console.log(this.cart)
    this.itemCount = this.cart.length + 1;
  }

  checkOut() {
    // Couldnt find a way to pass data due to how the components are set up.
    // Proposal solution: Navbar should just hold all the components instead
    // https://medium.com/ableneo/how-to-pass-data-between-routed-components-in-angular-2306308d8255
    // https://stackoverflow.com/questions/44864303/send-data-through-routing-paths-in-angular
    if (this.cart.length === 0) {
      this.error = 'Your cart is empty';
      return;
    }

    if (!this.source) {
      this.error = 'Please select a source';
      return;
    }

    if (!this.destin) {
      this.error = 'Please select a destination';
      return;
    }

    this.map.showMap(this.source, this.destin);
    let distance = this.map.getDistance();
    console.log(distance)

    let obj = { cart: this.cart, distance: distance }
    this.cartService.setData(obj);
    this.router.navigate(['/cart']);
    return;
  }

  constructor(private router: Router, private cartService :CartService) {
    this.getFlowers(0);
    this.cart = [];
  }

  updateData(event?: PageEvent) {
    this.pageSize = event.pageSize;
    this.getFlowers(event.pageIndex);
  }

  async getFlowers(page) {
    let tempCar = await getAllFlower(page, this.pageSize);
    this.allFlower = tempCar.data.data;
    this.length = tempCar.data.row;
  }

  setPageSizeOptions(setPageSizeOptionsInput: string) {
    if (setPageSizeOptionsInput) {
      this.pageSizeOptions = setPageSizeOptionsInput.split(',').map(str => +str);
    }
  }

  getSourceAddress(place: object) {
    this.source = place['formatted_address'];
  }

  getDestinAddress(place: object) {
    this.destin = place['formatted_address'];
  }

  showMap() {
    if (this.source && this.destin)
      this.map.showMap(this.source, this.destin);
    else alert('Please provide your source and destination')
  }

  getFlowerImgSrc(id) {
    const max = 5
    if (id <= max) return `../../../assets/img/flower/flower${id}.jpeg`;
    return '../../../assets/img/flower/plc.jpeg';
  }

  ngOnChanges(): void {
  }
  ngOnInit(): void { }

}
