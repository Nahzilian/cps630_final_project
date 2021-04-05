import { Component, Input } from '@angular/core';

@Component({
  selector: 'about-card',
  templateUrl: './about-card.component.html',
  styleUrls: ['./about-card.component.sass']
})
export class AboutCardComponent{
  @Input() name: string;
  @Input() student_number: string;
  @Input() job: string;
}
