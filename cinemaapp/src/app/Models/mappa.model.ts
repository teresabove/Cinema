/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
 import { posto } from './posto.model';
 export class mappa{
     public nomeschema: string = "";
     public matrice: Array<posto>[] = new Array();
     constructor(obj?: any) {
        this.setObj(obj);
     }
     
           setObj(obj?: any) {
            if (obj) {
            this.nomeschema = obj.nomeschema || this.nomeschema;
            this.matrice = obj.matrice || this.matrice;
         }
    }
     
 }


