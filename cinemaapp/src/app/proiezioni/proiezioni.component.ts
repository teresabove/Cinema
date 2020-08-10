import { Component, OnInit } from '@angular/core';
import {ApiService} from '../api.service';
import {proiezione} from '../Models/proiezione.model';
import { Router } from '@angular/router';
@Component({
  selector: 'app-proiezioni',
  templateUrl: './proiezioni.component.html',
  styleUrls: ['./proiezioni.component.css']
})
export class ProiezioniComponent implements OnInit {

  constructor(public sApi: ApiService, public router: Router) { }
  public proiezioni: Array<proiezione> = new Array();
  
      ngOnInit(): void {
          this.getProiezioni();
  }
  
       getProiezioni(){
      this.sApi.getProiezioni().subscribe(res =>{
       this.proiezioni= res;
       console.log(this.proiezioni);
       });
       }
       
       Verifica(){
           this.router.navigate(['/sala']);
       }

  }


