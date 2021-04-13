import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { NavbarComponent } from './navbar/navbar.component';
import { LoginFormComponent } from './login-form/login-form.component';
import { SignupFormComponent } from './signup-form/signup-form.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { MatToolbarModule } from '@angular/material/toolbar';
import { MatIconModule } from '@angular/material/icon';
import { MatCardModule } from '@angular/material/card';
import { MatInputModule } from '@angular/material/input';
import { MatButtonModule } from '@angular/material/button';
import { MatGridListModule } from '@angular/material/grid-list';
import { MatSidenavModule } from '@angular/material/sidenav';
import { MatListModule } from '@angular/material/list';
import { MatTabsModule } from '@angular/material/tabs';
import { MatExpansionModule } from '@angular/material/expansion';
import { MatPaginatorModule } from '@angular/material/paginator';
import { MatSelectModule } from '@angular/material/select';
import {MatChipsModule} from '@angular/material/chips';
import {MatButtonToggleModule} from '@angular/material/button-toggle';
import {MatSnackBarModule} from '@angular/material/snack-bar';
import {MatRippleModule} from '@angular/material/core';

import { FlexLayoutModule } from '@angular/flex-layout';
import { AboutUsComponent } from './about-us/about-us.component';
import { AboutCardComponent } from './about-us/about-card/about-card.component';
import { ContactUsComponent } from './contact-us/contact-us.component';
import { HomeComponent } from './home/home.component';
import { MainServicesComponent } from './main-services/main-services.component';
import { DriverServiceComponent } from './main-services/driver-service/driver-service.component';
import { FlowerServiceComponent } from './main-services/flower-service/flower-service.component';

import { AutocompleteAddressComponent } from './main-services/autocomplete-address/autocomplete-address.component';
import { MapComponent } from './main-services/map/map.component';
import { UserInfoComponent } from './user-info/user-info.component';
import { DragDropModule } from '@angular/cdk/drag-drop';
import { MyCartComponent } from './my-cart/my-cart.component';
import { UserReviewComponent } from './user-review/user-review.component';
import { ReviewCardComponent } from './user-review/review-card/review-card.component';
import { BrowserComponent } from './browser/browser.component';
import { GreenComponent } from './main-services/green/green.component';
import { DbMaintainComponent } from './db-maintain/db-maintain.component';
import { CreateFormComponent } from './db-maintain/create-form/create-form.component';
import { ComparingTableComponent } from './main-services/green/comparing-table/comparing-table.component';


@NgModule({
  declarations: [
    AppComponent,
    NavbarComponent,
    LoginFormComponent,
    SignupFormComponent,
    AboutUsComponent,
    ContactUsComponent,
    HomeComponent,
    MainServicesComponent,
    DriverServiceComponent,
    FlowerServiceComponent,
    AutocompleteAddressComponent,
    MapComponent,
    UserInfoComponent,
    MyCartComponent,
    AboutCardComponent,
    UserReviewComponent,
    ReviewCardComponent,
    BrowserComponent,
    GreenComponent,
    DbMaintainComponent,
    CreateFormComponent,
    ComparingTableComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    MatToolbarModule,
    MatIconModule,
    MatCardModule,
    MatInputModule,
    MatButtonModule,
    FormsModule,
    ReactiveFormsModule,
    MatGridListModule,
    FlexLayoutModule,
    MatSidenavModule,
    MatListModule,
    MatTabsModule,
    MatExpansionModule,
    MatPaginatorModule,
    DragDropModule,
    MatSelectModule,
    MatChipsModule,
    MatButtonToggleModule,
    MatSnackBarModule,
    MatRippleModule,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
