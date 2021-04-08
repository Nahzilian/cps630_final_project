import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AboutUsComponent } from './about-us/about-us.component';
import { ContactUsComponent } from './contact-us/contact-us.component';
import { HomeComponent } from './home/home.component';
import { LoginFormComponent } from './login-form/login-form.component';
import { MainServicesComponent } from './main-services/main-services.component';
import { MyCartComponent } from './my-cart/my-cart.component';
import { SignupFormComponent } from './signup-form/signup-form.component';
import { UserInfoComponent } from './user-info/user-info.component';
import { UserReviewComponent } from './user-review/user-review.component';

const routes: Routes = [
  {path: "", component: HomeComponent},
  {path: "login", component: LoginFormComponent},
  {path: "signup", component: SignupFormComponent},
  {path: "about", component: AboutUsComponent},
  {path: "contact", component: ContactUsComponent},
  {path: "services", component: MainServicesComponent},
  {path: "me", component: UserInfoComponent},
  {path: "cart", component: MyCartComponent},
  {path: "review", component: UserReviewComponent},
  {path: "**", redirectTo: '/' , pathMatch: 'full'},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
