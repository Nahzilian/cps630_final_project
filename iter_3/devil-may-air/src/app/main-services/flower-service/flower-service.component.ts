import { CdkDragDrop, moveItemInArray, transferArrayItem } from '@angular/cdk/drag-drop';
import { Component, OnInit, ViewChild, OnChanges, Output, EventEmitter } from '@angular/core';
import { PageEvent } from '@angular/material/paginator';
import Flower from 'src/models/flower';
import { MapComponent } from '../map/map.component';
import { getAllFlower, findReview } from '../../../utils/api/publicAPI';
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

  //Review Content
  allReviews: Array<number>;

  constructor(private router: Router, private cartService :CartService) {
    this.getFlowers(0);
    this.cart = [];
  }

  drop(event: CdkDragDrop<string[]>) {
    //this.cart.push()
    setTimeout(() => {
      transferArrayItem(event.previousContainer.data,
        event.container.data,
        event.previousIndex,
        event.currentIndex);
        this.itemCount = this.cart.length;
    })
  }

  updateReview(){
    // Get Reviews
    for (let i = 0; i < this.allFlower.length; i++) {
      const element = this.getReview(this.allFlower[i]);
      this.allFlower[i].usersVoted = 0;
      this.allFlower[i].score = 0;
      element.then((e)=>{
        let score = 0;
        let totUsers = 0;
        e.data.forEach(element => {
          score += element.score;
          totUsers++;
        });
        this.allFlower[i].usersVoted = totUsers;
        let tot = (score/totUsers) * 5;
        this.allFlower[i].score = tot < 0? 0:tot;

      });

    }
  }
  async getReview(id){

    let reviews = await findReview(id._id);

    return reviews;
  }

  checkOut() {
    if (this.cart.length === 0) {
      this.error = 'Your cart is empty';
      setInterval(()=> {this.error = ''}, 6000)
      return;
    }

    if (!this.source) {
      this.error = 'Please select a source';
      setInterval(()=> {this.error = ''}, 6000)
      return;
    }

    if (!this.destin) {
      this.error = 'Please select a destination';
      setInterval(()=> {this.error = ''}, 6000)
      return;
    }

    let obj = { cart: this.cart, source: this.source, destin: this.destin }
    this.cartService.setData(obj, 'flower');
    this.router.navigate(['/cart', { type: 'flower' }]);
  }


  updateData(event?: PageEvent) {
    this.pageSize = event.pageSize;
    this.getFlowers(event.pageIndex);

  }

  async getFlowers(page) {
    let tempCar = await getAllFlower(page, this.pageSize);
    this.allFlower = tempCar.data.data;
    this.length = tempCar.data.row;

    this.updateReview();
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

  ngOnChanges(): void { }

  ngOnInit(): void { }

}
