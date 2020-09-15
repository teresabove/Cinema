import { Component, OnInit } from '@angular/core';
import {ApiService} from '../api.service';
import { Router, NavigationEnd } from '@angular/router';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css'],
})
export class HomeComponent implements OnInit {
public res: string= "";
    constructor(public sApi: ApiService, public router: Router) {

  }
    
  ngOnInit(): void {
        this.verificaInstall();
  }

  
  gotoAreaUser(){
      if (this.sApi.isLoggedIn()){
      this.router.navigate(['/profilo']);} 
      else { this.router.navigate(['/user']);}
  }
  
   gotoAreaFilm(){
      this.router.navigate(['/areafilm']);
  }
  
   gotoRicerca(){
      this.router.navigate(['/search']);
  }
  /*
  prova(){
      this.sApi.getprova().subscribe(res=>{
          console.log('riposta api prova',res);
      });
  }*/
  
    verificaInstall(){
        this.sApi.getInstall().subscribe(res=>{
            console.log(res);
               if (res =='update'){
               console.log('Update');
                this.router.navigate(['/install']);         
            } else {
               console.log('Already installed');
            } 
        });    
  }
}
  
  
  
