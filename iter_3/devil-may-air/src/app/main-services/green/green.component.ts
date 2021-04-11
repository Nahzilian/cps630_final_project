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
  carPin1 : Car;
  carPin2: Car;
  numPins: number = 0;

  constructor() {
    
    this.getCars(0);
   }

  ngOnInit(): void {
  }

  compare(){
    let pin = this.pin2;
    let children = pin.children;
    let card = children[2] as HTMLElement;
    let content = card.children[1] as HTMLElement;
    let score = content.children[0] as HTMLElement;
    
    if( (isNaN(this.carPin2.score) || this.carPin1.score === 0)  && (isNaN(this.carPin1.score) || this.carPin2.score === 0) ){
      score.innerHTML = `no user review <i style="color: gold" class="fas fa-minus"></i>`;
    }else if(isNaN(this.carPin2.score)){
      score.innerHTML = `no user review <i style="color: red" class="fas fa-sort-down"></i>`;
    }
    else if(this.carPin1.score > this.carPin2.score){
      
      score.innerHTML = `${this.carPin2.score}/5 <i style="color: red" class="fas fa-sort-down"></i>`;
    }else if(this.carPin1.score < this.carPin2.score){
      score.innerHTML = `${this.carPin2.score.toFixed(1)}/5 <i style="color: green" class="fas fa-sort-up"></i>`;
      
    }else if(this.carPin2.score === this.carPin1.score){
      score.innerHTML = `${this.carPin2.score.toFixed(1)}/5 <i style="color: gold" class="fas fa-minus"></i>`;
    }
    
  }

  onPin(elem: HTMLElement, car:Car){
    let children = null;
    let pin = null;
    if(this.pin1 == elem){
      this.numPins = 1;
      pin = elem.children[0] as HTMLElement;
      pin.style.color = 'black';
      pin = this.pin2.children[0] as HTMLElement;
      pin.style.color = 'black';
      var card = this.pin2.children[2] as HTMLElement;
      var content = card.children[1] as HTMLElement;
      var score = content.children[0] as HTMLElement;
      
      if(isNaN(this.carPin2.score)){
        score.innerHTML = "no user reviews";
      }else{
        score.innerHTML = `${this.carPin2.score.toFixed(1)}/5`;
      }
      this.pin1 = null as HTMLElement;
      this.pin2 = null as HTMLElement;
      this.carPin1 = null as Car;
      this.carPin2 = null as Car;
      return;
    }

    if(!this.pin1){
      this.pin1 = elem;
      this.carPin1 = car;
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
        var card = temp.children[2] as HTMLElement;
        var content = card.children[1] as HTMLElement;
        var score = content.children[0] as HTMLElement;
        
        if(isNaN(this.carPin2.score)){
          score.innerHTML = "no user reviews";
        }else{
          score.innerHTML = `${this.carPin2.score.toFixed(1)}/5`;

        }
      }
      this.carPin2 = car;
      this.compare();
      this.numPins = 2;
    }
    
  }

  async getReview(id){

    let reviews = await findReview(id);
    
    return reviews;
  }

  updateReview(arr){
    // Get Reviews
    for (let i = 0; i < arr.length; i++) {
      const element = this.getReview(this.allCar[i].carCode);
      arr[i].usersVoted = 0;
      arr[i].score = 0;
      element.then((e)=>{
        let score = 0;
        let totUsers = 0;
        e.data.forEach(element => {
          score += element.score;
          totUsers++;
        });
        arr[i].usersVoted = totUsers;
        let tot = (score/totUsers) * 5;
        arr[i].score = tot < 0? 0:tot;
        
      });
      
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
    
    this.updateReview(this.allCar);
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
