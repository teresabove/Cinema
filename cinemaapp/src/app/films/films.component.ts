import { Component, OnInit } from '@angular/core';
import {ApiService} from '../api.service';
import {film} from '../Models/film.model';
import { Router } from '@angular/router';
@Component({
  selector: 'app-films',
  templateUrl: './films.component.html',
  styleUrls: ['./films.component.css']
})
export class FilmsComponent implements OnInit {
  public films: Array<film> = new Array();
  constructor(public sApi: ApiService, public router: Router) { }

  ngOnInit(): void {
      this.getFilms();
  }
  
  getFilms(){
      this.sApi.getFilms().subscribe(res =>{
       this.films= res;
       console.log(this.films);
       });
  }
  
  getDetails(titolo: string){
      localStorage.setItem('titolo', titolo);
      console.log(titolo);
      this.router.navigate(['/film']/*{state: {data: {titolo: this.film.titolo}}}*/);
  }
  
  goHome(){
      this.router.navigate(['/home']);
  }

}
