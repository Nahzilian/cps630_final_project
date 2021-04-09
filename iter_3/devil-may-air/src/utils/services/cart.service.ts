/// <reference types="@types/googlemaps" />
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class CartService {
  private data: any = undefined;

  // constructor() { }
  setData(data: any) {
    var cart = data.cart;
    var obj = { ... data, cart: this.flowerFormat(cart)}
    this.data = obj;
  }
  getData() {
    return this.data;
  }

  flowerFormat (data: any) {
    data.forEach(element => {
      element.quantity = 1;
    });
    return data;
  }
  getDistance(org, des, callback) {
    var direction = new google.maps.DirectionsService();
    var directionRequest = {
      origin: org,
      destination: des,
      travelMode: google.maps.TravelMode.DRIVING,
      unitSystem: google.maps.UnitSystem.METRIC
    }
    direction.route(
      directionRequest,
      (res, status) => {
        if (status === google.maps.DirectionsStatus.OK) {
          var totalDistance = 0;
          var legs = res.routes[0].legs;
          console.log(res.routes)
          for(var i=0; i<legs.length; ++i) {
            totalDistance += legs[i].distance.value;
          }
          callback(totalDistance/1000);
          }
        }
      )
    }
}
