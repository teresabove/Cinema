import { Component, OnInit } from '@angular/core';
import { posto } from '../Models/posto.model';
import { biglietto } from '../Models/biglietto.model';
import { ApiService } from '../api.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-biglietto',
  templateUrl: './biglietto.component.html',
  styleUrls: ['./biglietto.component.css']
})
export class BigliettoComponent implements OnInit {
      public p : posto = new posto();
      public posti : Array<posto> = new Array();
  constructor(public router: Router) { }

  ngOnInit(): void {
      var posti = JSON.parse(localStorage.getItem('posti'));
      this.posti=posti;
      console.log(this.posti);
      }
      
      gotoAcquisto(){
          localStorage.setItem('posti',JSON.stringify(this.posti));
          this.router.navigate(['/acquisto']);
      }
  
  

}
