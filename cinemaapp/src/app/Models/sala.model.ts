/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
 export class sala{
     public nomesala: string="";
     public numeroposti: number;
     public numerofile: number;
     public nomeschema: string ="";
     
      constructor(obj?: any) {
        this.setObj(obj);
    }
    
    setObj(obj?: any) {
        if (obj) {
            this.nomesala= obj.nomesala || this.nomesala;
            this.nomeschema= obj.nomeschema || this.nomeschema;
            this.numerofile= obj.numerofile || this.numerofile;
            this.numeroposti= obj.numeroposti || this.numeroposti;
            //this.numeroposti = (typeof obj.numeroposti === "number") ? obj.numeroposti : this.numeroposti;
            //this.numerofile = (typeof obj.numerofile === "number") ? obj.numerofile : this.numerofile;
            
         }
 }
 }


