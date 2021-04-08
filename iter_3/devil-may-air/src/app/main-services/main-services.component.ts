import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-main-services',
  templateUrl: './main-services.component.html',
  styleUrls: ['./main-services.component.sass']
})
export class MainServicesComponent implements OnInit {
  ordered: boolean;

  constructor() {
    this.ordered = true;
  }

  ngOnInit(): void {
  }

}
