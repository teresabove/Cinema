import { Component, OnInit } from '@angular/core';
import { ApiService } from '../api.service';
import { Router } from '@angular/router';
import { posto } from '../Models/posto.model';
import { credenziale } from '../Models/credenziale.model';
import { biglietto } from '../Models/biglietto.model';
import { proiezione } from '../Models/proiezione.model';

@Component({
  selector: 'app-pagamento',
  templateUrl: './pagamento.component.html',
  styleUrls: ['./pagamento.component.css']
})
export class PagamentoComponent implements OnInit {
  public importo: number =0;
  public posti : Array<posto> = new Array();
  public carte: Array<credenziale> = new Array();
  public ticket: biglietto = new biglietto();
  constructor(public router: Router, private sApi: ApiService) { }

  ngOnInit(): void {
      //1- verifica del login utente 
      if (this.sApi.isLoggedIn()){        
      var importo =localStorage.getItem('importo');
      this.importo= parseInt(importo);
      var posti= JSON.parse(localStorage.getItem('posti'));
      this.posti=posti;
      var proiezione = JSON.parse(localStorage.getItem('proiezione')); 
      var idutente= localStorage.getItem('idutente');
      //this.carte = this.getCarte(idutente)    
         this.ticket.riepilogo = "prova";
         this.ticket.idutente = '2';
         console.log(this.ticket);
      } //false
      else {
          console.log('Devi effettuare il login');
      }       
  }
  
  getCarte(idutente: string){
     this.sApi.getCredenziale(idutente);
  }
  
  Pagamento(ticket: biglietto){
      this.sApi.postBiglietto(ticket).subscribe(res=>{
        console.log('response',res)});
  }
}
