import { Injectable } from '@angular/core';
import {Observable} from 'rxjs';
import {map} from 'rxjs/operators';
import {Router} from '@angular/router';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {film} from './Models/film.model';
import {guest} from './Models/guest.model';
import {mappa} from './Models/mappa.model';
import {profilo} from './Models/profilo.model';
import {posto} from './Models/posto.model';
import {proiezione} from './Models/proiezione.model';
import {sala} from './Models/sala.model';
import {credenziale} from './Models/credenziale.model';
import {biglietto} from './Models/biglietto.model';


@Injectable({
  providedIn: 'root'
})
export class ApiService {
     public films: Array<film>= new Array();
     public filmsbygen: Array<film> = new Array();
     public proiezioni: Array<proiezione> = new Array();
     public carte: Array<credenziale> = new Array();
     public posti: Array<posto> = new Array();
     public biglietti: Array<biglietto> = new Array();
     
   constructor(private httpClient: HttpClient, private router: Router) { }
   
           
    postBiglietto(biglietto: any): Observable<biglietto>{
        const headers = { 'content-type': 'application/json'};
        const biglietto_json= JSON.stringify(biglietto);
        return this.httpClient.post<any>('http://localhost/progetto/cinema/public/index.php/api/biglietto/add', biglietto_json , {'headers': headers});    
    }
    
    postPosto(posto: posto) : Observable<posto>{
       const headers = { 'content-type': 'application/json'};
       const posto_json = JSON.stringify(posto);
       return this.httpClient.post<posto>('http://localhost/progetto/cinema/public/index.php/api/posto/add', posto_json , {'headers': headers});
    }
    
   
    postGuest(guest: any): Observable<any>{
       const headers = { 'content-type': 'application/json'};
       //const obj = JSON.stringify(guest);     
       return this.httpClient.post<any>('http://localhost/progetto/cinema/public/index.php/api/user/add', guest, {'headers': headers});
       }
      
      //verify user credentials on server to get token  
    postLogin(email: any, password: any): Observable<any>{
        const headers = { 'content-type': 'application/json'};
        const email_json =JSON.stringify(email);
        const password_json = JSON.stringify(password);
        return this.httpClient.post<any>('http://localhost/progetto/cinema/public/index.php/api/user/login',{ email_json , password_json }, {'headers': headers});
        }
    
        //after login save token and (if any) other values in localStorage
    setUser(res){
        localStorage.setItem('email',res.email);
        localStorage.setItem('jwt',res.jwt);
        localStorage.setItem('idutente',res.idutente);
        this.router.navigate(['/profilo']);
    } 
    
    isLoggedIn(){
        return localStorage.getItem('jwt') != null;
    }
    
    getToken(): string{
        return localStorage.getItem('jwt');
    }
    
    getProfilo(): Observable<profilo>{
        const headers = {'content-type': 'application/json'};
        var idutente = JSON.parse(localStorage.getItem('idutente'));
        return this.httpClient.get<profilo>('http://localhost/progetto/cinema/public/index.php/api/profilo/'+ idutente,{'headers': headers})
        .pipe(
        map( res => new profilo(res)));
        }
    
    
    getFilms(): Observable<film[]>{
        const headers = {'content-type': 'application/json'};
        return this.httpClient.get<film[]>('http://localhost/progetto/cinema/public/index.php/api/film/all',{'headers': headers})
        .pipe(
        map(res=> this.films= res));
        }
        
     getFilmbytitolo(): Observable<film>{
      let title =localStorage.getItem('titolo');
      const headers = {'content-type': 'application/json'};
      return this.httpClient.get<film>('http://localhost/progetto/cinema/public/index.php/api/film/'+title,{'headers': headers})
      .pipe(
      map(res=> new film(res)));   
     }
    
    
    getFilmsbyGenere(genere: string): Observable<film[]>{
    const headers = {'content-type': 'application/json'};
    return this.httpClient.get<film[]>('http://localhost/progetto/cinema/public/index.php/api/film/genere/'+ genere, {'headers': headers})
    .pipe(
    map(res => this.filmsbygen = res));
    }
    
    //vedere array input
    getFilmsbyCast(attore: any): Observable<film[]>{
    const headers = {'content-type': 'application/json'};
    return this.httpClient.get<film[]>('http://localhost/progetto/cinema/public/index.php/api/film/cast/+'+attore, {'headers': headers});
    }
    
    getSalaattribute(nomesala: string): Observable<sala>{
     const headers = {'content-type': 'application/json'};
     return this.httpClient.get<mappa>('http://localhost/progetto/cinema/public/index.php/api/sala/'+nomesala,{'headers': headers})
     .pipe(
     map(res=> new sala(res)));  
    }
    
    getProiezionebytitolo(titolo: string): Observable<proiezione[]>{
     const headers = {'content-type': 'application/json'};
     return this.httpClient.get<proiezione[]>('http://localhost/progetto/cinema/public/index.php/api/proiezione/'+titolo,{'headers': headers})
     .pipe(
     map(res=> this.proiezioni=res));   
    }
    
    getProiezioni(): Observable<proiezione[]>{
        const headers = {'content-type': 'application/json'};
        return this.httpClient.get<proiezione[]>('http://localhost/progetto/cinema/public/index.php/api/proiezione/all',{'headers': headers})
        .pipe(
        map(res=> this.proiezioni= res));
        }
        
    getCredenziale(idutente: string): Observable<credenziale[]>{
        const headers = {'content-type': 'application/json'};
        return this.httpClient.get<credenziale[]>('http://localhost/progetto/cinema/public/index.php/api/profilo/credenziale/'+idutente,{'headers': headers})
        .pipe(
        map(res=> this.carte=res));
        }
    
    getPostiOcc(idproiezione: string): Observable<posto[]>{
        const headers = {'content-type': 'application/json'};
        return this.httpClient.get<posto[]>('http://localhost/progetto/cinema/public/index.php/api/posto/'+ idproiezione, {'headers': headers})
        .pipe (
        map(res=> this.posti =res));
    }
    
    getBigbyId(idutente: string): Observable<biglietto[]>{
       const headers = {'content-type': 'application/json'};
        return this.httpClient.get<biglietto[]>('http://localhost/progetto/cinema/public/index.php/api/biglietto/'+ idutente, {'headers': headers})
        .pipe (
        map(res=> this.biglietti =res));
    }
        
    }

/*
Angular9 HttpClient è modulo integrato che ci aiuta nell'inviare richieste di rete
al nostro server di riferimento. HttpClientModule è usato per mandare richieste
GET, POST, PUT, DELETE. La nostra appicazione comunica con i servizi di backend 
attraveerso un protocollo HTTP. 
 */
