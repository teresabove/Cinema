/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 export class credenziale {
    public circuitocarta: string="";
    public numerocarta: string="";
    public scadenza: string="";
   
    
     constructor(obj?: any) {
        this.setObj(obj);
    }
    
      setObj(obj?: any) {
        if (obj) {
            this.circuitocarta = obj.circuitocarta || this.circuitocarta;
            this.numerocarta = obj.numerocarta || this.numerocarta;
            this.scadenza = obj.scadenza || this.scadenza;
         }
    }
}




