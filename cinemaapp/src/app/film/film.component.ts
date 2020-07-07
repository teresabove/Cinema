import { Component, OnInit } from '@angular/core';
import {ApiService} from '../api.service';
import {film} from '../Models/film.model';
import { Router } from '@angular/router';
@Component({
  selector: 'app-film',
  templateUrl: './film.component.html',
  styleUrls: ['./film.component.css']
})
export class FilmComponent implements OnInit {
   public film: film = new film();
  constructor(public sApi: ApiService, public router: Router) { }

  ngOnInit(): void {
      this.sApi.getFilmbytitolo().subscribe(res=>{
      this.film=res;
        console.log(this.film);  
  });

}
gotoHome(){
    this.router.navigate(['/home']);
}
}
