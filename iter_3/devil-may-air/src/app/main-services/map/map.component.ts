/// <reference types="@types/googlemaps" />
import { Component, ViewChild, ElementRef, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-map',
  templateUrl: './map.component.html',
  styleUrls: ['./map.component.sass']
})

export class MapComponent {
  @ViewChild('myMap') myMap: ElementRef;
  map: google.maps.Map;
  distance: number;
  constructor() {
  }

  getDistance() {
    return this.distance
  }

  showMap(org, des) {
    const mapOpt = {
      zoom: 12
    }
    let elem = this.myMap.nativeElement
    elem.style.width = '100vw'
    elem.style.height = '30vh'
    this.map = new google.maps.Map(elem, mapOpt);
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
          this.distance = res.routes[0].legs[0].distance.value;
          new google.maps.DirectionsRenderer({
            map: this.map,
            directions: res
          })
        }
        else alert('Error: unable to retrieve your route')
      }
    )
  }
}
