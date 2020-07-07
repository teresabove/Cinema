/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 import { mappa } from './mappa.model';
export class proiezione{
    public film: string ="";
    public sala: string ="";
    public giorno: Date;
    public orario: Date;
    public mappaproiezione: mappa= new mappa();
    public tipo: any;
    
     constructor(obj?: any) {
        this.setObj(obj);
    }
    
     
    
}


