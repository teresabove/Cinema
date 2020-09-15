import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { UserComponent } from './user/user.component';
import { ProfiloComponent } from './profilo/profilo.component';
import { FilmComponent } from './film/film.component';
import { FilmsComponent } from './films/films.component';
import { ResearchComponent } from './research/research.component';
import { SalaComponent } from './sala/sala.component';
import { BigliettoComponent } from './biglietto/biglietto.component';
import { AcquistoComponent } from './acquisto/acquisto.component';
import { ProiezioniComponent } from './proiezioni/proiezioni.component';
import { ProiezioneComponent } from './proiezione/proiezione.component';
import { PagamentoComponent } from './pagamento/pagamento.component';
import { InstallazioneComponent } from './installazione/installazione.component';


const routes: Routes = [
     { path: 'home', component: HomeComponent }, 
     { path: 'user', component: UserComponent },
     { path: 'profilo', component: ProfiloComponent },
     { path: 'film', component: FilmComponent},
     { path: 'areafilm', component: FilmsComponent},
     { path: '', redirectTo: '/home', pathMatch: 'full' },  //loclhs:4200->home       
     { path: 'search', component: ResearchComponent},
     { path: 'sala', component: SalaComponent},
     { path: 'biglietto', component: BigliettoComponent},
     { path: 'acquisto', component: AcquistoComponent},
     { path: 'areaspettacoli', component: ProiezioniComponent},
     { path: 'spettacoli/:titolo', component: ProiezioneComponent},
     { path: 'pagamento', component: PagamentoComponent},
     { path: 'install', component: InstallazioneComponent},    
];

@NgModule({
  imports: [RouterModule.forRoot(routes, { useHash: true })],
  exports: [RouterModule]
})
export class AppRoutingModule { }
