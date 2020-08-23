import { Component, OnInit, ViewChild, ElementRef } from '@angular/core';
import { ApiService } from '../api.service';
import { Router } from '@angular/router';
import { posto } from '../Models/posto.model';
import { credenziale } from '../Models/credenziale.model';
import { biglietto } from '../Models/biglietto.model';
import { proiezione } from '../Models/proiezione.model';
import { NgbModalConfig, NgbModal, ModalDismissReasons, NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';

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
  public spettacolo: proiezione = new proiezione();
  constructor(public router: Router, private sApi: ApiService, private modalService: NgbModal) { }
  
  //@ViewChild(TemplateRef) contentRef: TemplateRef; 
  //@ViewChild('content', {static: true}) contentRef: ElementRef;

  ngOnInit(): void {
      //1- verifica del login utente 
      if (this.sApi.isLoggedIn()){        
      var importo =localStorage.getItem('importo');
      this.importo= parseInt(importo);
      console.log('importo', importo);
      var posti= JSON.parse(localStorage.getItem('posti'));
      this.posti=posti;
      console.log(this.posti);
      var proiezione = JSON.parse(localStorage.getItem('proiezione'));
      this.spettacolo= proiezione; 
      console.log(this.spettacolo);
      var idutente= localStorage.getItem('idutente');        
         this.ticket.riepilogo = JSON.stringify(posti)+ ' ' + JSON.stringify(proiezione);
         this.ticket.idutente = idutente;
         console.log(this.ticket);
      } //false
      else {
          console.log('Devi effettuare il login per fare un acquisto');
          this.Avviso();
      }       
  }
  
  getCarte(idutente: string){
     this.sApi.getCredenziale(idutente);
  }
  
  Pagamento(ticket: biglietto){
      this.sApi.postBiglietto(ticket).subscribe(res=>{
        console.log('response',res)}); 
       this.OccupaPosto(this.posti); 
            
  }
  
  OccupaPosto(posti: posto[]){
      for(var i = 0;i<posti.length;i++) { 
      var posto = this.posti[i];
      posto.proiezione = this.spettacolo.idproiezione;
      console.log(posto);
      this.sApi.postPosto(posto).subscribe(res=>{
          console.log('response',res)
      });
   }  
  }
  
  Avviso(){
      this.modalService.open('Per acquistare il biglietto è necessario aver effettutato il login. Sarai reindirizzato alla pagina USER per \n\
                              poter effettuare il LOGIN, nel caso già hai un account registrato \n\
                              o per poter effettuare una REGISTRAZIONE, nel caso non hai un account registrato.');
                              this.router.navigate(['/user'])
  }
}
