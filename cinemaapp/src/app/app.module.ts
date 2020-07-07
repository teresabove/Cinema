import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { HomeComponent} from './home/home.component';
import { UserComponent} from './user/user.component';
import { AppRoutingModule} from './app-routing.module';
import { AppComponent } from './app.component';
import { HttpClientModule } from '@angular/common/http';   
import { FormsModule, ReactiveFormsModule} from '@angular/forms';
import { ProfiloComponent } from './profilo/profilo.component'; 
import { JwtModule } from '@auth0/angular-jwt';
import { FilmComponent } from './film/film.component';
import { StorageServiceModule } from 'ngx-webstorage-service';
import { FilmsComponent } from './films/films.component';
import { ResearchComponent } from './research/research.component';
import { SalaComponent } from './sala/sala.component';
import { BigliettoComponent } from './biglietto/biglietto.component';
import { AcquistoComponent } from './acquisto/acquisto.component';
import { ProiezioniComponent } from './proiezioni/proiezioni.component';
import {NgbModule} from '@ng-bootstrap/ng-bootstrap';
        
  @NgModule({
  declarations: [
    AppComponent,
    UserComponent,
    ProfiloComponent,
    FilmComponent,
    FilmsComponent,
    ResearchComponent,
    SalaComponent,
    BigliettoComponent,
    AcquistoComponent,
    ProiezioniComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule,
    JwtModule,
    StorageServiceModule,
    NgbModule
  ],
  providers: [],
  
  bootstrap: [AppComponent]
})


export class AppModule { }
