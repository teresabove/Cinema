/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
 export class posto{
     public fila: number;
     public numero: number;
     public occupato: boolean = false;
     
       constructor(obj?: any) {
        this.setObj(obj);
     }
     
            setObj(obj?: any) {
            if (obj) {
            this.fila= obj.fila || this.fila;
            this.numero = obj.numero || this.numero;
            this.occupato = obj.occupato || this.occupato;
         }
    }
 }
 
 


