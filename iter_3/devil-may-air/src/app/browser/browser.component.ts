import { Component, OnInit } from '@angular/core';

declare global{
  interface Document {
    documentMode?: any;
  }
}

function isBrowserIE() {
    return window.document.documentMode;
}

@Component({
  selector: 'app-browser',
  templateUrl: './browser.component.html',
  styleUrls: ['./browser.component.sass']
})
export class BrowserComponent implements OnInit {
  browserName: string;
  browserVersion: string;
  click: boolean = false;

  constructor() { }

  ngOnInit(): void {
    this.browserName = this.myBrowser();
    this.browserVersion = this.getBrowserVersion();
  }

  myBrowser() {

     if((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1 ) {

         return 'Opera';

     }else if(navigator.userAgent.indexOf("Chrome") != -1 ){

         return 'Chrome';

     }else if(navigator.userAgent.indexOf("Safari") != -1){

         return 'Safari';

     }else if(navigator.userAgent.indexOf("Firefox") != -1 ) {

          return 'Firefox';

     }else if(navigator.userAgent.indexOf("MSIE") != -1 ){

       return 'IE';

     } else {

        return 'unknown';

     }

 }

 getBrowserVersion(){

     var userAgent= navigator.userAgent, tem,

     matchTest= userAgent.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];

     if(/trident/i.test(matchTest[1])){

         tem=  /\brv[ :]+(\d+)/g.exec(userAgent) || [];

         return 'IE '+(tem[1] || '');

     }

     if(matchTest[1]=== 'Chrome'){

         tem= userAgent.match(/\b(OPR|Edge)\/(\d+)/);

         if(tem!= null) return tem.slice(1).join(' ').replace('OPR', 'Opera');

     }

     matchTest= matchTest[2]? [matchTest[1], matchTest[2]]: [navigator.appName, navigator.appVersion, '-?'];

     if((tem= userAgent.match(/version\/(\d+)/i))!= null) matchTest.splice(1, 1, tem[1]);

     return matchTest.join(' ');

 }

  getDetails(){
    this.click = this.click? false:true;
  }
}
