import { Component, OnInit, ViewChild } from '@angular/core';
import { PageEvent } from '@angular/material/paginator';
import { getAllCar, getAllFlower } from '../../utils/api/publicAPI';
import Car from 'src/models/car';
import Flower from 'src/models/flower';
import { MatTabChangeEvent } from '@angular/material/tabs';

@Component({
  selector: 'app-db-maintain',
  templateUrl: './db-maintain.component.html',
  styleUrls: ['./db-maintain.component.sass']
})
export class DbMaintainComponent implements OnInit {
  @ViewChild('tabGroup') tabGroup;
  allCar: Array<Car>;
  allFlower: Array<Flower>;

  panelOpenState = false;

  tabIndex = 0;

  length = 100;
  pageSize = 10;
  pageSizeOptions: number[] = [5, 10, 25, 100];

  // MatPaginator Output
  pageEvent: PageEvent;

  updateData(event?: PageEvent) {
    this.pageSize = event.pageSize;
    if(this.tabIndex === 0) this.getCars(event.pageIndex);
    if(this.tabIndex === 1) this.getFlowers(event.pageIndex);
  }

  setPageSizeOptions(setPageSizeOptionsInput: string) {
    if (setPageSizeOptionsInput) {
      this.pageSizeOptions = setPageSizeOptionsInput.split(',').map(str => +str);
    }
  }

  getCarImgSrc(id) {
    const max = 5
    if (id <= max) return `../../assets/img/car/car${id}.jpeg`;
    return '../../assets/img/car/plc.jpeg';
  }

  getFlowerImgSrc(id) {
    const max = 5
    if (id <= max) return `../../assets/img/flower/flower${id}.jpeg`;
    return '../../assets/img/flower/plc.jpeg';
  }


  async getCars(page) {
    let tempCar = await getAllCar(page, this.pageSize);
    this.allCar = tempCar.data.data;
    this.length = tempCar.data.row;
  }

  async getFlowers(page) {
    let tempCar = await getAllFlower(page, this.pageSize);
    this.allFlower = tempCar.data.data;
    this.length = tempCar.data.row;
  }



  constructor() {
    this.getCars(0);
    this.getFlowers(0);
  }

  ngOnInit(): void {
  }
  tabChanged(tabChangeEvent: MatTabChangeEvent): void {
    this.tabIndex = tabChangeEvent.index;
  }

}
