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

@Injectable({
  providedIn: 'root'
})
export class ApiService {
     public films: Array<film>= new Array();
     public filmsbygen: Array<film> = new Array();
     
   constructor(private httpClient: HttpClient, private router: Router) { }
   
    postGuest(guest: any): Observable<guest>{
       const headers = { 'content-type': 'application/json'};
       const obj = JSON.stringify(guest);     
       return this.httpClient.post<any>('http://localhost/progetto/cinema/public/index.php/api/user/add', obj, {'headers': headers});
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
        this.router.navigate(['/home']);
    } 
    
    isLoggedIn(){
        return localStorage.getItem('jwt') != null;
    }
    
    getProfilo(): Observable<profilo>{
        const headers = {'content-type': 'application/json'};
        var email = JSON.parse(localStorage.getItem('email'));
        return this.httpClient.get<profilo>('http://localhost/progetto/cinema/public/index.php/api/profilo/'+ email,{'headers': headers})
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
    
    getSalaattribute(nomeschema: string): Observable<mappa>{
     const headers = {'content-type': 'application/json'};
     return this.httpClient.get<mappa>('http://localhost/progetto/cinema/public/index.php/api/mappa/'+nomeschema,{'headers': headers})
     .pipe(
     map(res=> new mappa(res)));  
    }

}
    

/*
Angular9 HttpClient è modulo integrato che ci aiuta nell'inviare richieste di rete
al nostro server di riferimento. HttpClientModule è usato per mandare richieste
GET, POST, PUT, DELETE. La nostra appicazione comunica con i servizi di backend 
attraveerso un protocollo HTTP. 
 */
