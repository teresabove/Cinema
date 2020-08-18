import { Component, OnInit } from '@angular/core';
import {Observable} from 'rxjs';
import {ApiService} from '../api.service';
import { Router, NavigationEnd } from '@angular/router';
import * as $ from "jquery";

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css'],
})
export class HomeComponent implements OnInit {
    
     active =1;
  
      constructor(public sApi: ApiService, public router: Router) {
      router.events.subscribe(s => {
      if (s instanceof NavigationEnd) {
        const tree = router.parseUrl(router.url);
        if (tree.fragment) {
          const element = document.querySelector("#" + tree.fragment);
          if (element) { element.scrollIntoView(); }
        }
      }
    });
  }
    
  ngOnInit(): void {  
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
  
  prova(){
      this.sApi.getprova().subscribe(res=>{
          console.log('riposta api prova',res);
      });
      
      
      
  }
  
  }
  
