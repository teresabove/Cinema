/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 import { mappa } from './mappa.model';
export class proiezione{
    public film: string ="";
    public sala: string ="";
    public giorno: string = "";
    public orario: string="";
    public mappaproiezione: mappa= new mappa();
    public tipo: any;
    public idproiezione: string = "";
    public imgspettacolo: any;
    
     constructor(obj?: any) {
        this.setObj(obj);
    }
    
           setObj(obj?: any) {
        if (obj) {
            this.film = obj.film || this.film;
            this.sala = obj.sala || this.sala;
            this.giorno = obj.giorno || this.giorno;
            this.orario = obj.orario || this.orario;
            this.mappaproiezione= obj.mappaproiezione || this.mappaproiezione;
            this.tipo= obj.tipo || this.tipo;
            this.idproiezione = obj.idproiezione || this.idproiezione;
            this.imgspettacolo = obj.imgspettacolo || this.imgspettacolo;
         }
    }
    
     
    
}


