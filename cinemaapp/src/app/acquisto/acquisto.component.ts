import { Component, OnInit } from '@angular/core';
import { ApiService } from '../api.service';
import { Router } from '@angular/router';
import { posto } from '../Models/posto.model';
import {NgbModal, ModalDismissReasons} from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-acquisto',
  templateUrl: './acquisto.component.html',
  styleUrls: ['./acquisto.component.css']
})
export class AcquistoComponent implements OnInit {
   
  constructor(public router: Router, private modalService: NgbModal) { }
  public posti : Array<posto> = new Array();
  public importi: Array<number>;
  public importo: number = 0;
  closeResult: string;
  public tipo: string = "";
  public tipi: Array<string>;
  
  ngOnInit(): void {
      var posti = JSON.parse(localStorage.getItem('posti'));
      this.posti=posti;
      let length = this.posti.length;
      this.importi = new Array(length);
      this.tipi = new Array(length);
      console.log(this.importi);          
  }
  
  Scegli(event: any){
      this.tipo= event.target.value;
      console.log(this.tipo);
      for (let i=0; i< this.importi.length; i++){
      if (this.tipo == 'young'){
          this.importi[i]=6
          this.tipi[i]= "Young";
      } else if (this.tipo == 'full'){
          this.importi[i]=7;
          this.tipi[i]= "Full";
      }else if (this.tipo == 'senior'){
          this.importi[i]=5;
          this.tipi[i]= "Senior";
      }
     }
      console.log(this.importi);
      console.log(this.tipi);
      localStorage.setItem('importo',JSON.stringify(this.importi));
    }
    
  Apri(content) {
    this.modalService.open(content, {ariaLabelledBy: 'modal-basic-title'}).result.then((result) => {
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
      return  `with: ${reason}`;
    }
  }
   
 Paga(content){
     this.modalService.dismissAll();
     this.router.navigate(['/pagamento']);
     
 }
}
