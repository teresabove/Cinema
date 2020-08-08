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
  public postiocc : Array<posto> = new Array();
  public count: Array<posto> = new Array();
  public proiezione: proiezione = new proiezione();
  public r: number;
  public c: number;
  constructor(public sApi: ApiService, public router: Router) { }

  
      
     ngOnInit(): void {
    this.proiezione = JSON.parse(localStorage.getItem('proiezione'));
    console.log(this.proiezione);
    this.getOccupati(this.proiezione.idproiezione);
    this.sApi.getSalaattribute(this.proiezione.sala).subscribe(res => {
          this.sala=res;
          console.log(this.sala);
          this.r = this.sala.numerofile; 
          this.c = this.sala.numeroposti/this.r;        
           for (let i=0; i< this.r; i++){
              this.mappa.matrice[i]=[];
              for (let j=0; j< this.c; j++){
               var p = new posto();
                 p.fila= i;
                 p.numero = j;
             this.mappa.matrice[i][j]=p; //p è un oggetto posto, quindi fcc il controllo se p esiste con condizione true per occupato in array occupati
              this.isOccupato(p, this.postiocc);        
             }; 
           };
           console.log(this.mappa.matrice);
           });
       }
          
  Seleziona(posto){
      this.count.push(posto);
      console.log(this.count);
      localStorage.setItem('posti',JSON.stringify(this.count));  
  }

  gotoBiglietto(){
      this.router.navigate(['/biglietto']);
  }
  
  getOccupati(idproiezione: string){
     this.sApi.getPostiOcc(idproiezione).subscribe(res =>{
         this.postiocc=res;
         console.log(this.postiocc);
     });
  }
  
  isOccupato(p: posto, postiocc: posto[]){
      for (let i=0; i< postiocc.length; i++){
          if (postiocc[i].fila == p.fila && postiocc[i].numero == p.numero){
          p.occupato = true;
          console.log('res occ',p);
          return p;
      }
  }
  }
  
}
  

