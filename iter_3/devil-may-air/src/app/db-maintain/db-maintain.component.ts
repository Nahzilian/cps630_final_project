import { Component, OnInit, ViewChild } from '@angular/core';
import { PageEvent } from '@angular/material/paginator';
import { getAllCar, getAllFlower } from '../../utils/api/publicAPI';
//getAllUserForDBMaintain
import { getAllUserForDBMaintain, getTrips, getOrders, getReviews } from '../../utils/api/apiController';
import Car from 'src/models/car';
import Flower from 'src/models/flower';
import { MatTabChangeEvent } from '@angular/material/tabs';
import { Router } from '@angular/router';
import User from 'src/models/user';
import Trip from 'src/models/trips';

@Component({
  selector: 'app-db-maintain',
  templateUrl: './db-maintain.component.html',
  styleUrls: ['./db-maintain.component.sass']
})
export class DbMaintainComponent implements OnInit {
  @ViewChild('tabGroup') tabGroup;
  allCar: Array<Car>;
  allFlower: Array<Flower>;
  allUsers: Array<User>;
  allTrip: Array<Trip>;
  allOrder: Array<Trip>;
  allReview: Array<any>;

  panelOpenState = false;

  tabIndex = 0;

  length = 100;
  pageSize = 10;
  pageSizeOptions: number[] = [5, 10, 25, 100];

  // MatPaginator Output
  pageEvent: PageEvent;

  updateData(event?: PageEvent) {
    this.pageSize = event.pageSize;
    if (this.tabIndex === 0) this.getCars(event.pageIndex);
    if (this.tabIndex === 1) this.getFlowers(event.pageIndex);
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

  async getAllUserForDBMaintain() {
    let tempUsers = await getAllUserForDBMaintain();
    this.allUsers = tempUsers.data;
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

  async getTrips() {
    let tempTrip = await getTrips();
    this.allTrip = tempTrip.data;
  }

  async getOrders() {
    let tempOrder = await getOrders();
    this.allOrder = tempOrder.data;
    console.log(this.allOrder)
  }

  async getReviews() {
    let tempReview = await getReviews();
    this.allReview = tempReview.data;
  }

  constructor(private router: Router) {
    const user = JSON.parse(localStorage.getItem('user'));
    if (!user.isAdmin) this.router.navigate(['/']);
    this.getCars(0);
    this.getFlowers(0);
    this.getAllUserForDBMaintain();
    this.getTrips();
    this.getOrders();
    this.getReviews();
  }

  ngOnInit(): void {
  }
  tabChanged(tabChangeEvent: MatTabChangeEvent): void {
    this.tabIndex = tabChangeEvent.index;
  }

}
