import { Component, OnInit, ViewChild } from '@angular/core';
import { getAllCar, findReview } from '../../../utils/api/publicAPI';
import { PageEvent } from '@angular/material/paginator';

import Car from '../../../models/car';
import { MapComponent } from '../map/map.component';

@Component({
  selector: 'app-driver-service',
  templateUrl: './driver-service.component.html',
  styleUrls: ['./driver-service.component.sass'],
})
export class DriverServiceComponent implements OnInit {
@ViewChild (MapComponent) map!: MapComponent;
  allCar: Array<Car>;
  panelOpenState = false;

  length = 100;
  pageSize = 10;
  pageSizeOptions: number[] = [5, 10, 25, 100];

  // MatPaginator Output
  pageEvent: PageEvent;

  // Google map
  source: string;
  destin: string;

  
  //Review Content 
  allReviews: Array<number>;
  
  async getReview(id){

    let reviews = await findReview(id);
    
    return reviews;
  }

  updateReview(){
    // Get Reviews
    for (let i = 0; i < this.allCar.length; i++) {
      const element = this.getReview(this.allCar[i].carCode);
      this.allCar[i].usersVoted = 0;
      this.allCar[i].score = 0;
      element.then((e)=>{
        let score = 0;
        let totUsers = 0;
        e.data.forEach(element => {
          score += element.score;
          totUsers++;
        });
        this.allCar[i].usersVoted = totUsers;
        let tot = (score/totUsers) * 5;
        this.allCar[i].score = tot < 0? 0:tot;
        
      });
      
    }
  }

  updateData (event?: PageEvent) {
    this.pageSize = event.pageSize;
    this.getCars(event.pageIndex);

    
    
  }
  
  setPageSizeOptions(setPageSizeOptionsInput: string) {
    if (setPageSizeOptionsInput) {
      this.pageSizeOptions = setPageSizeOptionsInput.split(',').map(str => +str);
    }
  }
  
  constructor() {
    this.getCars(0);
    
  }
  
  async getCars(page) {
    let tempCar = await getAllCar(page, this.pageSize);
    this.allCar = tempCar.data.data;
    this.length = tempCar.data.row;
    
    this.updateReview();
  }
  
  getSourceAddress(place: object) {
    this.source = place['formatted_address'];
  }
  
  getDestinAddress(place: object) {
    this.destin = place['formatted_address'];
  }

  getCarImgSrc(id) {
    const max = 5
    if (id <= max) return `../../../assets/img/car/car${id}.jpeg`;
    return '../../../assets/img/car/plc.jpeg';
  }

  showMap () {
    if(this.source && this.destin)
      this.map.showMap(this.source, this.destin);
    else alert('Please provide your source and destination')
  }

  ngOnInit(): void {}

}
