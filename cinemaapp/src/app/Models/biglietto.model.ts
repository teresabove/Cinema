/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

export class biglietto{
    public riepilogo: any;
    public idutente: string;
    
    
          constructor(obj?: any) {
        this.setObj(obj);
         }
    
        setObj(obj?: any) {
        if (obj) {
            this.riepilogo= obj.riepilogo || this.riepilogo;
            this.idutente= obj.idutente || this.idutente;            
         } 
         }
    
}

    
    