import { Component, ElementRef, OnInit, ViewChild } from '@angular/core';

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

  // pins
  pin1: HTMLElement;
  pin2: HTMLElement;
  numPins: number = 0;

  constructor() {
    
    this.getCars(0);
   }

  ngOnInit(): void {
  }

  onPin(elem: HTMLElement){
    let children = null;
    let pin = null;
    if(this.pin1 == elem){
      this.numPins = 1;
      pin = elem.children[0] as HTMLElement;
      pin.style.color = 'black';
      pin = this.pin2.children[0] as HTMLElement;
      pin.style.color = 'black';
      this.pin1 = null as HTMLElement;
      this.pin2 = null as HTMLElement;
      return;
    }

    if(!this.pin1){
      this.pin1 = elem;
      children = elem.children;
      pin = children[0] as HTMLElement;
      pin.style.color = "red";
      this.numPins = 1;
    }else{
      let temp = null as HTMLElement;
      if(this.numPins == 2)
        temp = this.pin2;
      this.pin2 = elem;
      children = elem.children;
      pin = children[0] as HTMLElement;
      pin.style.color = "green";
      
      if(temp){
        let tempPin = temp.children[0] as HTMLElement;
        tempPin.style.color = 'black';
        
      }
      this.numPins = 2;
    }
    
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

  
  getCarImgSrc(id) {
    const max = 5
    if (id <= max) return `../../../assets/img/car/car${id}.jpeg`;
    return '../../../assets/img/car/plc.jpeg';
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
