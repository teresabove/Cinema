import { Component, OnInit } from '@angular/core';
import { FormGroup, Validators, FormBuilder, FormControl } from '@angular/forms';
import {ApiService} from '../api.service';
import {guest} from '../Models/guest.model';
import { Router } from '@angular/router';

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css']
})
export class UserComponent implements OnInit {
      constructor(public ApiS: ApiService, private formBuilder: FormBuilder, public router: Router) {}     
          title = 'Area utente: login e registrazione';
          guest = new guest();
          authForm: FormGroup;
          isSubmitted  =  false;
          control = false;
          control1= false;
          value= "";
             
  ngOnInit() {
        this.authForm  =  this.formBuilder.group({
        email: ['', Validators.required],
        password: ['', Validators.required]})}
  
get formControls() { 
return this.authForm.controls; }

signIn(){
    this.isSubmitted = true;
    if(this.authForm.invalid){
      return;
    }
    this.guest.email= this.authForm.value.email;
    this.guest.password=this.authForm.value.password;
    //console.log(this.guest);
    this.ApiS.postGuest(this.guest).subscribe(res=>{
       this.value=res;
       console.log(this.value);
    });
    if (this.value = 'email exists'){
    this.control1= true;
    } else {
     // this.sApi.postLogin()
    }
  }
  
  signUp(){
      this.isSubmitted = true;
      if(this.authForm.invalid){
      return;
    }
    var email= this.authForm.value.email;
    var password= this.authForm.value.password;
    this.ApiS.postLogin(email, password).subscribe(res=>{
        console.log(res);
    if (res && res.res== 'ok'){
        this.control = false;
        this.ApiS.setUser(res);
    } else
    if (res.res== 'ko'){
       this.control = true;
    }
    });
    }
    
     logOut(){
        localStorage.clear();
        this.router.navigate(['/home']);
    }
    
 }
  
/*ngModel, ngForm e ngSubmit sono direttive per creare template-based from for
 registrare gli utenti
 In questo file abbiamo definito la funzione OnClickSubmit, che triggerà 
 quando l'utente clicca il bottone submit sul form
*/