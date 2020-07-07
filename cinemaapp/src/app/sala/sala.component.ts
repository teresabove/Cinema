 import { Component, OnInit } from '@angular/core';
import { ApiService } from '../api.service';
import { sala } from '../Models/sala.model'; 
import { mappa } from '../Models/mappa.model'; 
import { posto } from '../Models/posto.model';
import { Router } from '@angular/router';
import * as $ from "jquery";

@Component({
  selector: 'app-sala',
  templateUrl: './sala.component.html',
  styleUrls: ['./sala.component.css']
})
export class SalaComponent implements OnInit {
  public mappa: mappa= new mappa();
  public posti : Array<posto> = new Array();
  public count: Array<posto> = new Array();

  constructor(public sApi: ApiService, public router: Router) { }

  public nomeschema: string = 'schema_sala_blu';
      
     ngOnInit(): void {
    this.sApi.getSalaattribute(this.nomeschema).subscribe(res => {
          this.mappa=res;
          console.log(this.mappa);
          var length = this.mappa.matrice.length;
           for (let i=0; i< length; i++){
               var p= new posto();
            p.fila=this.mappa.matrice[i].fila;
            p.numero=this.mappa.matrice[i].numero;
            p.occupato=this.mappa.matrice[i].occupato;
            this.posti[i]=p;
            }
          });
          };
         
  
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
  

