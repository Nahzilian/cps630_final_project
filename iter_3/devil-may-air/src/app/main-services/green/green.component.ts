import { Component, ElementRef, OnInit, ViewChild } from '@angular/core';

import { getAllCar, findReview, getAllFlower } from '../../../utils/api/publicAPI';
import Car from '../../../models/car';
import { MapComponent } from '../map/map.component';
import { FormControl } from '@angular/forms';
import { PageEvent } from '@angular/material/paginator'; 
import Flower from 'src/models/flower';

@Component({
  selector: 'app-green',
  templateUrl: './green.component.html',
  styleUrls: ['./green.component.sass']
})
export class GreenComponent implements OnInit {
  @ViewChild (MapComponent) map!: MapComponent;

  allCar: Array<Car>;
  allFlower: Array<Flower>;
  
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
  flowerPin1: Flower;
  flowerPin2: Flower;
  numPins: number = 0;

  constructor() {
    
    this.getCars(0);
    this.getFlowers(0);
   }

  ngOnInit(): void {
  }

  compareCars(){
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
    }else if(isNaN(this.carPin1.score) && !isNaN(this.carPin2.score)){
      score.innerHTML = `${this.carPin2.score.toFixed(1)}/5 <i style="color: green" class="fas fa-sort-up"></i>`;

    }
    
  }

  compareFlowers(pin1, pin2){
    let pin = this.pin2;
    let children = pin.children;
    let card = children[2] as HTMLElement;
    let content = card.children[1] as HTMLElement;
    let price = children[3].children[0] as HTMLElement;
    let score = content.children[0] as HTMLElement;
    
    
    if( (isNaN(pin2.score) || pin1.score === 0)  && (isNaN(pin1.score) || pin2.score === 0) ){
      score.innerHTML = `no user review <i style="color: gold" class="fas fa-minus"></i>`;
    }else if(isNaN(pin2.score)){
      score.innerHTML = `no user review <i style="color: red" class="fas fa-sort-down"></i>`;
    }
    else if(pin1.score > pin2.score){
      
      score.innerHTML = `${pin2.score}/5 <i style="color: red" class="fas fa-sort-down"></i>`;
    }else if(pin1.score < pin2.score){
      score.innerHTML = `${pin2.score.toFixed(1)}/5 <i style="color: green" class="fas fa-sort-up"></i>`;
      
    }else if(pin2.score === pin1.score){
      score.innerHTML = `${pin2.score.toFixed(1)}/5 <i style="color: gold" class="fas fa-minus"></i>`;
    }else if(isNaN(pin1.score) && !isNaN(pin2.score)){
      score.innerHTML = `${pin2.score.toFixed(1)}/5 <i style="color: green" class="fas fa-sort-up"></i>`;

    }

    if(pin1.price > pin2.price){
      price.innerHTML = `${pin2.price.toFixed(2)}$ <i style="color: red" class="fas fa-sort-down"></i>`;
    }else if(pin1.price < pin2.price){
      price.innerHTML = `${pin2.price.toFixed(2)}$ <i style="color: green" class="fas fa-sort-up"></i>`;
    }else{
      price.innerHTML = `${pin2.price.toFixed(2)}$ <i style="color: gold" class="fas fa-minus"></i>`;
    }
  }

  onPinCar(elem: HTMLElement, car: Car){
    let children = null;
    let pin = null;
    if(this.flowerPin1){
      this.reset();
    }
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
      this.compareCars();
      this.numPins = 2;
    }
    
  }

  onPinFlower(elem: HTMLElement, flower: Flower){
    let children = null;
    let pin = null;
    if(this.carPin1){
      this.reset();
    }
    if(this.pin1 == elem){
      this.numPins = 1;
      pin = elem.children[0] as HTMLElement;
      pin.style.color = 'black';
      pin = this.pin2.children[0] as HTMLElement;
      pin.style.color = 'black';
      var card = this.pin2.children[2] as HTMLElement;
      var content = card.children[1] as HTMLElement;
      var score = content.children[0] as HTMLElement;
      var price = this.pin2.children[3].children[0] as HTMLElement;
      
      if(isNaN(this.flowerPin2.score)){
        score.innerHTML = "no user reviews";
      }else{
        score.innerHTML = `${this.flowerPin2.score.toFixed(1)}/5`;
      }
      price.innerHTML = `${flower.price.toFixed(2)}$`;

      this.pin1 = null as HTMLElement;
      this.pin2 = null as HTMLElement;
      this.flowerPin1 = null as Flower;
      this.flowerPin2 = null as Flower;
      return;
    }

    if(!this.pin1){
      this.pin1 = elem;
      this.flowerPin1 = flower;
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
        var price = temp.children[3].children[0] as HTMLElement;
        
        if(isNaN(this.flowerPin2.score)){
          score.innerHTML = "no user reviews";
        }else{
          score.innerHTML = `${this.flowerPin2.score.toFixed(1)}/5`;
        }
        price.innerHTML = `${this.flowerPin2.price.toFixed(2)}$`;

      }
      this.flowerPin2 = flower;
      this.compareFlowers(this.flowerPin1, this.flowerPin2);
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
      let code = arr[0].hasOwnProperty('carCode')? arr[i].carCode : arr[i]._id;
      const element = this.getReview(code);
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
    this.getFlowers(event.pageIndex);
    return event;
  }

  async getCars(page) {
    let tempCar = await getAllCar(page, this.pageSize);
    this.allCar = tempCar.data.data;
    this.length = tempCar.data.row;
    
    this.updateReview(this.allCar);
    this.reset();
  }

  async getFlowers(page) {
    let tempCar = await getAllFlower(page, this.pageSize);
    this.allFlower = tempCar.data.data;
    this.length = tempCar.data.row;
    this.updateReview(this.allFlower);
    this.reset();    
  }

  reset(){
    this.pin1 = null;
    this.pin2 = null;
    this.carPin1 = null;
    this.carPin2 = null;
    this.flowerPin1 = null;
    this.flowerPin2 = null;
    this.numPins = 0;

  }
  
  getCarImgSrc(id) {
    const max = 5
    if (id <= max) return `../../../assets/img/car/car${id}.jpeg`;
    return '../../../assets/img/car/plc.jpeg';
  }
  
  getFlowerImgSrc(id) {
    const max = 5
    if (id <= max) return `../../../assets/img/flower/flower${id}.jpeg`;
    return '../../../assets/img/flower/plc.jpeg';
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
