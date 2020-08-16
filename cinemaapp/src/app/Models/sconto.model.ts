/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 export class sconto{
     public idsconto: number;
     public descrizione: string = "";
     public baseapplicazione: number;
          
      constructor(obj?: any) {
        this.setObj(obj);
    }
    
    setObj(obj?: any) {
        if (obj) {
            this.idsconto= obj.idsconto || this.idsconto;
            this.descrizione= obj.descrizione || this.descrizione;
            this.baseapplicazione= obj.baseapplicazione || this.baseapplicazione;
                        
         }
 }
 }

