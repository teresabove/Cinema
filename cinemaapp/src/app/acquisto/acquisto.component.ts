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
  public importo: number = 0;
  closeResult: string;
  public tipo: string = "";
  
  ngOnInit(): void {
      var posti = JSON.parse(localStorage.getItem('posti'));
      this.posti=posti;          
  }
  
  Scegli(event: any){
      let length = this.posti.length;
      this.tipo= event.target.value;
      console.log(this.tipo);
      if (this.tipo == 'young'){
          this.importo= this.importo + 5;
      } else if (this.tipo == 'full'){
          this.importo= this.importo + 6;
      }else if (this.tipo == 'senior'){
          this.importo= this.importo + 5;
      }
      console.log(this.importo);
      localStorage.setItem('importo',JSON.stringify(this.importo));
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
   
 Paga(mymodal){
     //this.modalService.close();
     this.router.navigate(['/pagamento']);
     
 }
}
