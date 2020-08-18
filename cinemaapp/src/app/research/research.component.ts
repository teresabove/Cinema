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
  public value: string;
  public parametro: string;
  public films: Array<film>= new Array();
    
  constructor(public router: Router, private sApi: ApiService) { }

  ngOnInit(): void {
  }

    CambiaParametro(value: string){
    this.value= value;
    console.log('this value',this.value);
  }

   searchFilm(parametro:string){
       if (this.value= "genere"){
   this.sApi.getFilmsbyGenere(parametro).subscribe(res=>{
   this.films=res;
   console.log(this.films);
   });
       } else if (this.value= "attore"){
           this.sApi.getFilmsbyCast(parametro).subscribe(res=>{
               this.films=res;
               console.log(this.films);
           });
       }
   console.log(parametro);
  }

  
   getDetails(titolo: string){
      localStorage.setItem('titolo',titolo);
      this.router.navigate(['/film']/*{state: {data: {titolo: this.film.titolo}}}*/);
  }
  
}
