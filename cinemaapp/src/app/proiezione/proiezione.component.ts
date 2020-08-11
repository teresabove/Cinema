import { Component, OnInit } from '@angular/core';
import {ApiService} from '../api.service';
import {proiezione} from '../Models/proiezione.model';
import { Router } from '@angular/router';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-proiezione',
  templateUrl: './proiezione.component.html',
  styleUrls: ['./proiezione.component.css']
})
export class ProiezioneComponent implements OnInit {

  constructor(public sApi: ApiService, public router: Router, private actRoute: ActivatedRoute) { }
  
   public proiezioni: Array<proiezione> = new Array();
   public titolo: string;
   
  ngOnInit(): void {
      localStorage.removeItem('proiezione');
      this.titolo = this.actRoute.snapshot.paramMap.get('titolo');
      this.getProiezioni(this.titolo);
      //this.getTipoPr(this.proiezioni);
      }
  
  getProiezioni(titolo: string){
      this.sApi.getProiezionebytitolo(titolo).subscribe(res=>{
      this.proiezioni=res;  
      console.log(this.proiezioni);
    });

    }
  
         Verifica(proiezione: proiezione){
             localStorage.setItem('proiezione', JSON.stringify(proiezione));
            this.router.navigate(['/sala']);
       }
       
  

}
