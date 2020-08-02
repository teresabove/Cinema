import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import {ApiService} from '../api.service';
import {profilo} from '../Models/profilo.model';
import {credenziale} from '../Models/credenziale.model';
import { NgbModalConfig, NgbModal } from '@ng-bootstrap/ng-bootstrap';
@Component({
  selector: 'app-profilo',
  templateUrl: './profilo.component.html',
  styleUrls: ['./profilo.component.css']
})
export class ProfiloComponent implements OnInit {
  public prof: profilo = new profilo();
  public carte: Array<credenziale> = new Array();

  constructor(public router: Router, private sApi: ApiService, config: NgbModalConfig, private modalService: NgbModal) { }

  ngOnInit(){
      this.sApi.getProfilo().subscribe(res =>{
          this.prof= res;
          localStorage.setItem('idutente', this.prof.idutente);
       this.getCartebyId();
      });

  }
    getCartebyId(){
        let idutente= localStorage.getItem('idutente');
       this.sApi.getCredenziale(idutente).subscribe(res =>{
         this.carte=res;
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
    
    
 
}
