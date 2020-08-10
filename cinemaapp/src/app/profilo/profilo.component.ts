import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import {ApiService} from '../api.service';
import {profilo} from '../Models/profilo.model';
import {credenziale} from '../Models/credenziale.model';
import {biglietto} from '../Models/biglietto.model';
import { NgbModalConfig, NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';
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

  constructor(public router: Router, private sApi: ApiService, config: NgbModalConfig, private modalService: NgbModal) { }

  ngOnInit(){
      this.sApi.getProfilo().subscribe(res =>{
          this.prof= res;
          console.log(res);
          //localStorage.setItem('idutente', this.prof.idutente);
       this.getCartebyId();
       this.getBigliettibyId();
      });

  }
    getCartebyId(){
        let idutente= localStorage.getItem('idutente');
        if (idutente == "" ){
            console.log('profilo da creare');
       } else {
       this.sApi.getCredenziale(idutente).subscribe(res =>{
         this.carte=res;
    });}
    }
    
    getBigliettibyId(){
        let idutente= localStorage.getItem('idutente');
        if (idutente == ""){
            console.log('profilo da creare');
       } else {
       this.sApi.getBigbyId(idutente).subscribe(res =>{
         this.biglietti=res;
    });}
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
  
 /* jwt(){
     this.sApi.getProva().subscribe(res=> {
         console.log(res);
     }) */
  }
    
    
 

