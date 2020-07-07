/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
 import { posto } from './posto.model';
 export class mappa{
     public nomeschema: string = "";
     public numero_posti: number;
     public numero_file: number;
     public matrice: posto[];
     constructor(obj?: any) {
        this.setObj(obj);
     }
     
           setObj(obj?: any) {
            if (obj) {
            this.numero_file= (typeof obj.numero_file === "number") ? obj.numero_file : this.numero_file;
            this.numero_posti = (typeof obj.numero_posti === "number") ? obj.numero_posti : this.numero_posti;
            this.nomeschema = obj.nomeschema || this.nomeschema;
            this.matrice = obj.matrice || this.matrice;
         }
    }
     
 }


