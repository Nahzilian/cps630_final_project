import { Component, ElementRef, OnInit, Input } from '@angular/core';
import {MatExpansionPanel} from '@angular/material/expansion';

@Component({
  selector: 'app-comparing-table',
  templateUrl: './comparing-table.component.html',
  styleUrls: ['./comparing-table.component.sass']
})
export class ComparingTableComponent implements OnInit {

  @Input() pin1: HTMLElement;
  @Input() pin2: HTMLElement;
  @Input() flowerPrice: HTMLElement;

  panelOpenState = false;
  constructor() { }

  ngOnInit(): void {
  }

  open(panel: MatExpansionPanel, container){
    this.panelOpenState = true;
    console.log(this.flowerPrice);
    
    container.style = `position: fixed; bottom:200px; 
    left:0; margin: 0 auto; height: 200px; width:50%; background-color:'lavender'`;
    
  }

  close(panel: MatExpansionPanel, container){
    this.panelOpenState = false;
    container.style = `position: fixed; bottom:-150px; 
    left:0; margin: 0 auto; height: 200px; width:50%; background-color:'lavender'`;
    
  }
  
  read(pin: HTMLElement){
    let img =`<img width=200 height=100 src=${pin.getElementsByTagName('img')[0].src}>`;
    let card = pin.children[2] as HTMLElement;
    let title = card.children[0].children[0].children[0];
    let code = card.children[0].children[0].children[1];
    let review = card.children[1].children[0];
    let res = img + `<div>NAME: ${title.innerHTML}</div>
    <div>CODE: ${code.innerHTML}</div><div>REVIEW: ${review.innerHTML}</div>`
    if(this.flowerPrice){
      res += `<div>${this.flowerPrice.innerHTML}</div>`;
    }
    return res;
  }


}
