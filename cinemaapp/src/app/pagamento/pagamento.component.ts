import { Component, OnInit } from '@angular/core';
import { ApiService } from '../api.service';
import { Router } from '@angular/router';
import { posto } from '../Models/posto.model';
import { credenziale } from '../Models/credenziale.model';
import { biglietto } from '../Models/biglietto.model';
@Component({
  selector: 'app-pagamento',
  templateUrl: './pagamento.component.html',
  styleUrls: ['./pagamento.component.css']
})
export class PagamentoComponent implements OnInit {
  public importo: number =0;
  public posti : Array<posto> = new Array();
  public carte: Array<credenziale> = new Array();
  public biglietti: Array<biglietto> = new Array();
  constructor(public router: Router, private sApi: ApiService) { }

  ngOnInit(): void {
      var importo =localStorage.getItem('importo');
      var posti= JSON.parse(localStorage.getItem('posti'));
      var proiezione = JSON.parse(localStorage.getItem('proiezione')); 
      var idutente= localStorage.getItem('idutente');
      this.getCarte(idutente); 
      
        
  }
  
  getCarte(idutente: string){
     this.sApi.getCredenziale(idutente);
  }
  
  

}
