import { Component, OnInit, ViewChild } from '@angular/core';

import { MapComponent } from '../map/map.component';

@Component({
  selector: 'app-green',
  templateUrl: './green.component.html',
  styleUrls: ['./green.component.sass']
})
export class GreenComponent implements OnInit {
  @ViewChild (MapComponent) map!: MapComponent;

  
  // Google map
  source: string;
  destin: string;

  constructor() { }

  ngOnInit(): void {
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
