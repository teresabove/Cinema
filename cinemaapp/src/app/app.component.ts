import { Component } from '@angular/core';
import { ApiService } from './api.service';
import { Router } from '@angular/router';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'cinemaapp';
  
  constructor(public sApi: ApiService,
              public router: Router) { }
  
      gotoAreaUser(){
      if (this.sApi.isLoggedIn()){
      this.router.navigate(['/profilo']);} 
      else { this.router.navigate(['/user']);}
  }
  
  gotoAreaFilm(){
      this.router.navigate(['/areafilm']);
  }
  
  gotoAreaSearch(){
      this.router.navigate(['/search']);
  }
  
  gotoAreaHome(){
      this.router.navigate(['/home']);
  }
      
}
