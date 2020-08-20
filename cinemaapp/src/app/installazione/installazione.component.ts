import { Component, OnInit } from '@angular/core';
import { ApiService } from '../api.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-installazione',
  templateUrl: './installazione.component.html',
  styleUrls: ['./installazione.component.css']
})
export class InstallazioneComponent implements OnInit {
   public admin: string ="";
   public pwd: string ="";
   public database: string ="";
   
  constructor(public sApi: ApiService, public router: Router) { }

  ngOnInit(): void {
  }
  
  conferma(admin: string, pwd: string, database: string){
      console.log(admin, pwd, database);
      this.sApi.postInstall(admin,pwd,database).subscribe(res=> {
          console.log(res);
      });
      
  }

}
