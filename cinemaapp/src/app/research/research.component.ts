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

  constructor(public router: Router, private sApi: ApiService) { }

  public films: Array<film>= new Array();
  genere: string;
  ngOnInit(): void {
  }

   searchFilm(genere:string){
   this.sApi.getFilmsbyGenere(genere).subscribe(res=>{
   this.films=res;
   console.log(this.films);
   })
  }
  
  goHome(){
      this.router.navigate(['/home']);
  }
  
   getDetails(titolo: string){
      localStorage.setItem('titolo',titolo);
      this.router.navigate(['/film']/*{state: {data: {titolo: this.film.titolo}}}*/);
  }
  
}
