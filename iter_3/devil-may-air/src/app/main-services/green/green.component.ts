import { Component, OnInit, ViewChild } from '@angular/core';

import { getAllCar, findReview } from '../../../utils/api/publicAPI';
import Car from '../../../models/car';
import { MapComponent } from '../map/map.component';
import { FormControl } from '@angular/forms';
import { PageEvent } from '@angular/material/paginator'; 

@Component({
  selector: 'app-green',
  templateUrl: './green.component.html',
  styleUrls: ['./green.component.sass']
})
export class GreenComponent implements OnInit {
  @ViewChild (MapComponent) map!: MapComponent;
  allCar: Array<Car>;
  
  length = 100;
  pageSize = 10;
  pageSizeOptions: number[] = [5, 10, 25, 100];

  pageEvent: PageEvent;

  toggleControl = new FormControl('driver');

  // Google map
  source: string;
  destin: string;

  constructor() { }

  ngOnInit(): void {
  }

  updateData (event?: PageEvent) {
    this.pageSize = event.pageSize;
    this.getCars(event.pageIndex);
    return event;
  }

  async getCars(page) {
    let tempCar = await getAllCar(page, this.pageSize);
    this.allCar = tempCar.data.data;
    this.length = tempCar.data.row;
    
    // this.updateReview();
  }

  getSourceAddress(place: object) {
    this.source = place['formatted_address'];
  }
  
  getDestinAddress(place: object) {
    this.destin = place['formatted_address'];
  }
  
  showMap () {
    if(this.source && this.destin)
      this.map.showMap(this.source, this.destin);
    else alert('Please provide your source and destination')
  }

}
