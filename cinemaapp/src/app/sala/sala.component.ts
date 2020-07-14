 import { Component, OnInit } from '@angular/core';
import { ApiService } from '../api.service';
import { sala } from '../Models/sala.model'; 
import { mappa } from '../Models/mappa.model'; 
import { posto } from '../Models/posto.model';
import { proiezione } from '../Models/proiezione.model';
import { Router } from '@angular/router';
import * as $ from "jquery";

@Component({
  selector: 'app-sala',
  templateUrl: './sala.component.html',
  styleUrls: ['./sala.component.css']
})
export class SalaComponent implements OnInit {
  public mappa: mappa= new mappa();
  public sala: sala= new sala();
  public posti : Array<posto> = new Array();
  public count: Array<posto> = new Array();
  public proiezione: proiezione = new proiezione();

  constructor(public sApi: ApiService, public router: Router) { }

  
      
     ngOnInit(): void {
    this.proiezione = JSON.parse(localStorage.getItem('proiezione'));
    console.log(this.proiezione);
    this.sApi.getSalaattribute(this.proiezione.sala).subscribe(res => {
          this.sala=res;
          console.log(this.sala);
          var rows = this.sala.numerofile; 
          var columns = this.sala.numeroposti/ rows;         
          console.log(rows,columns);
           for (let i=0; i< rows; i++){
              this.mappa.matrice[i]=[];
              for (let j=0; j< columns; j++){
             this.mappa.matrice[i][j]= new posto(j);
             } 
           }
           console.log(this.mappa.matrice);
         });
            
          }
          
         
  
  Seleziona(posto){
      console.log(posto);
      this.count.push(posto);
      console.log(this.count);
      localStorage.setItem('posti',JSON.stringify(this.count));  
  }

  gotoBiglietto(){
      this.router.navigate(['/biglietto']);
  }
  
  }
  

