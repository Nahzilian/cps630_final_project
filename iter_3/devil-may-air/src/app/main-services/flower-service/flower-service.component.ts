import { Component, OnInit, ViewChild } from '@angular/core';
import { PageEvent } from '@angular/material/paginator';
import Flower from 'src/models/flower';
import { MapComponent } from '../map/map.component';
import { getAllFlower } from '../../../utils/api/publicAPI';

@Component({
  selector: 'app-flower-service',
  templateUrl: './flower-service.component.html',
  styleUrls: ['./flower-service.component.sass']
})
export class FlowerServiceComponent implements OnInit {
  @ViewChild (MapComponent) map!: MapComponent;
  constructor() {
    this.getFlowers(0);
  }
  allFlower: Array<Flower>;
  panelOpenState = false;

  length = 100;
  pageSize = 10;
  pageSizeOptions: number[] = [5, 10, 25, 100];

  // MatPaginator Output
  pageEvent: PageEvent;

  // Google map
  source: string;
  destin: string;

  updateData (event?: PageEvent) {
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

  showMap () {
    if(this.source && this.destin)
      this.map.showMap(this.source, this.destin);
    else alert('Please provide your source and destination')
  }

  getFlowerImgSrc(id) {
    const max = 5
    if (id <= max) return `../../../assets/img/flower/flower${id}.jpeg`;
    return '../../../assets/img/flower/plc.jpeg';
  }

  ngOnInit(): void {
  }

}
