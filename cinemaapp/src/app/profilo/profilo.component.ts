import { Component, OnInit,  Input } from '@angular/core';
import { Router } from '@angular/router';
import {ApiService} from '../api.service';
import {profilo} from '../Models/profilo.model';
import {credenziale} from '../Models/credenziale.model';
import {biglietto} from '../Models/biglietto.model';
import { NgbModalConfig, NgbModal, ModalDismissReasons, NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';

  
        
 @Component({
  selector: 'app-profilo',
  templateUrl: './profilo.component.html',
  styleUrls: ['./profilo.component.css']
})
export class ProfiloComponent implements OnInit {
  public prof: profilo = new profilo();
  public carte: Array<credenziale> = new Array();
  public biglietti: Array<biglietto> = new Array();
  closeResult = '';
  configurato = false;
  constructor(public router: Router, private sApi: ApiService, public config: NgbModalConfig, private modalService: NgbModal) { }

  ngOnInit(){
      if (this.configurato == false){
            console.log('profilo da configurare');
            this.configura(this.configurato);  
        } else { 
      this.sApi.getProfilo().subscribe(res =>{
          this.prof= res;
          console.log(res);
        
       this.getCartebyId();
       this.getBigliettibyId();
      });
        }
  }  
  
  configura(content){
     this.modalService.open(content);
  } 
  
    getCartebyId(){
        let idutente= localStorage.getItem('idutente');
       this.sApi.getCredenziale(idutente).subscribe(res =>{
         this.carte=res;
         console.log('carte caricate',this.carte);
    });
    }
    
    getBigliettibyId(){
        let idutente= localStorage.getItem('idutente');
       this.sApi.getBigbyId(idutente).subscribe(res =>{
         this.biglietti=res;
         console.log('bigl acquistati',this.biglietti);
    });
    }
   
     toHome(){
     this.router.navigate(['/home']);
    }
    
       logOut(){
        localStorage.clear();
        this.router.navigate(['/home']);
    }
    
    getAcquisti(content){
        this.modalService.open(content);
    }
    
    getCarte(content1){
        this.modalService.open(content1);
     }
     
    modifica(content2) {
    this.modalService.open(content2, {ariaLabelledBy: 'modal-basic-title'}).result.then((result) => {
      this.closeResult = `Closed with: ${result}`;
    }, (reason) => {
      this.closeResult = `Dismissed ${this.getDismissReason(reason)}`;
    });
  }
  private getDismissReason(reason: any): string {
    if (reason === ModalDismissReasons.ESC) {
      return 'by pressing ESC';
    } else if (reason === ModalDismissReasons.BACKDROP_CLICK) {
      return 'by clicking on a backdrop';
    } else {
      return `with: ${reason}`;
    }
  }
  
  }
    
    
 

