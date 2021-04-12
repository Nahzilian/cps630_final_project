import { Component, OnInit, ViewChild } from '@angular/core';
import { PageEvent } from '@angular/material/paginator';
import { getAllCar, getAllFlower } from '../../utils/api/publicAPI';
//getAllUserForDBMaintain
import { getAllUserForDBMaintain, getTrips, getOrders, getReviews } from '../../utils/api/apiController';
import { deleteCar, deleteFlower, deleteOrder, deleteReview, deleteTrip, deleteUser } from '../../utils/api/apiController'
import Car from 'src/models/car';
import Flower from 'src/models/flower';
import { MatTabChangeEvent } from '@angular/material/tabs';
import { Router } from '@angular/router';
import User from 'src/models/user';
import Trip from 'src/models/trips';
import { FormControl, FormGroup } from '@angular/forms';

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
  error: string = '';
  tabIndex = 0;

  length = 100;
  pageSize = 10;
  pageSizeOptions: number[] = [5, 10, 25, 100];

  selectedData: any;
  selectedDataType: String = 'cars';
  isUpdating: boolean = false;

  // MatPaginator Output
  pageEvent: PageEvent;


  userForm: FormGroup = new FormGroup({
    name: new FormControl(''),
    email: new FormControl(''),
    phone: new FormControl(''),
    address: new FormControl(''),
    cityCode: new FormControl('')
  });

  carForm: FormGroup = new FormGroup({
    model: new FormControl(''),
    carCode: new FormControl(''),
    imageid: new FormControl(''),
    available: new FormControl('')
  })

  flowerForm: FormGroup = new FormGroup({
    price: new FormControl(''),
    flowerName: new FormControl(''),
    storeCode: new FormControl(''),
    imageid: new FormControl(''),
    quantity: new FormControl('')
  })

  tripForm: FormGroup = new FormGroup({
    source: new FormControl(''),
    destination: new FormControl(''),
    distance: new FormControl(''),
    carId: new FormControl(''),
    price: new FormControl(''),
  })

  orderForm: FormGroup = new FormGroup({
    dateDone: new FormControl(''),
    dateIssued: new FormControl(''),
  });

  reviewForm: FormGroup = new FormGroup({
    review: new FormControl(''),
    score: new FormControl(''),
    type: new FormControl(''),
  })

  setSelectedData (data) {
    this.selectedData =  data;
    if (this.tabIndex === 0) this.selectedDataType = 'cars'
    if (this.tabIndex === 1) this.selectedDataType = 'flowers'
    if (this.tabIndex === 2) this.selectedDataType = 'users'
    if (this.tabIndex === 3) this.selectedDataType = 'trips'
    if (this.tabIndex === 4) this.selectedDataType = 'orders'
    if (this.tabIndex === 5) this.selectedDataType = 'reviews'
    this.updateDataOnChange()
  }

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
    this.allOrder = tempOrder.data
  }

  async getReviews() {
    let tempReview = await getReviews();
    this.allReview = tempReview.data;
  }

  constructor(private router: Router) {
    const user = JSON.parse(localStorage.getItem('user'));
    if (!user.isAdmin) this.router.navigate(['/']);
    this.refreshData();
  }

  deleteItem(id) {
    if (this.tabIndex === 0) deleteCar(id);
    if (this.tabIndex === 1) deleteFlower(id);
    if (this.tabIndex === 2) deleteUser(id);
    if (this.tabIndex === 3) deleteTrip(id);
    if (this.tabIndex === 4) deleteOrder(id);
    if (this.tabIndex === 5) deleteReview(id);
    this.refreshData();
  }

  refreshData(){
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

  submitCar() {
    if (this.carForm.valid) {
      try {
        // addCar(this.carForm.controls);
      } catch (err) {
        this.error = err
      }
    }
  }

  submitUser() {
    if (this.userForm.valid) {
      try {
        // register(this.userForm.controls);
      } catch (err) {
        this.error = err
      }
    }
  }

  submitFlower() {

  }

  submitTrip() {

  }

  submitOrder() {

  }

  updateDataOnChange() {
    if (this.selectedData) {
      if (this.selectedDataType === 'cars') {
        this.carForm.patchValue({
          model: this.selectedData.model,
          carCode: this.selectedData.carCode,
          imageid: this.selectedData.imageid,
          available: this.selectedData.available
        })
      }
      if (this.selectedDataType === 'flowers') {
        this.flowerForm.patchValue({
          flowerName: this.selectedData.flowerName,
          storeCode: this.selectedData.storeCode,
          imageid: this.selectedData.imageid,
          quantity: this.selectedData.quantity,
          price: this.selectedData.price,
        })
      }
      if (this.selectedDataType === 'users') {
        this.userForm.patchValue({
          name: this.selectedData.name,
          address: this.selectedData.address,
          cityCode: this.selectedData.cityCode,
          email: this.selectedData.email,
          phone: this.selectedData.phone,
        })
      }
      if (this.selectedDataType === 'trips') {
        this.tripForm.patchValue({
          name: this.selectedData.name,
          address: this.selectedData.address,
          cityCode: this.selectedData.cityCode,
          email: this.selectedData.email,
          phone: this.selectedData.phone,
        })
      }
      if (this.selectedDataType === 'orders') {
        this.orderForm.patchValue({
          dateDone: this.selectedData.dateDone,
          dateIssued: this.selectedData.dateIssued,
        })
      }
      if (this.selectedDataType === 'reviews') {
        this.reviewForm.patchValue({
          review: this.selectedData.review,
          score: this.selectedData.score,
          type: this.selectedData.type,
        })
      }
    }
  }

}
