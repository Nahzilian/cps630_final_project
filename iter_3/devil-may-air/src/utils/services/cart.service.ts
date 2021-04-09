import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class CartService {
  private data: any = undefined;

  // constructor() { }
  setData(data: any) {
    this.data = data;
  }
  getData() {
    return this.data;
  }
}
