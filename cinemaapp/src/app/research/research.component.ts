import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import {ApiService} from '../api.service';
import {film} from '../Models/film.model';
@Component({
  selector: 'app-research',
  templateUrl: './research.component.html',
  styleUrls: ['./research.component.css']
})
export class ResearchComponent implements OnInit {

  public parametro: string;
  public parametro1: string;
  public films: Array<film>= new Array();
    
  constructor(public router: Router, private sApi: ApiService) { }

  ngOnInit(): void {
  }

   searchFilmbyG(parametro:string){
   this.sApi.getFilmsbyGenere(parametro).subscribe(res=>{
   this.films=res;
   console.log(this.films);
   });      
  }
  
   searchFilmbyC(parametro1:string){
   this.sApi.getFilmsbyCast(parametro1).subscribe(res=>{
   this.films=res;
   console.log(this.films);
   });      
  }

  
   getDetails(titolo: string){
      localStorage.setItem('titolo',titolo);
      this.router.navigate(['/film']/*{state: {data: {titolo: this.film.titolo}}}*/);
  }
  
  //cercabyGenere(parametro)
  
}
