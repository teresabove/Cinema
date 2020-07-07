/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
export class film {
    public titolo: string="";
    public regista: string ="";
    public anno: number;
    public durata: number;;
    public a_generi: string[] ;
    public a_cast: string[];
    public casaproduzione: string ="";
    public trama: string="";
    
     constructor(obj?: any) {
        this.setObj(obj);
    }
    
      setObj(obj?: any) {
        if (obj) {
            this.anno= (typeof obj.anno === "number") ? obj.anno : this.anno;
            this.durata = (typeof obj.durata === "number") ? obj.durata : this.durata;
            this.titolo = obj.titolo || this.titolo;
            this.regista = obj.regista || this.regista;
            this.casaproduzione = obj.casaproduzione || this.casaproduzione;
            this.a_generi = obj.a_generi || this.a_generi;
            this.a_cast= obj.a_cast || this.a_cast;
            this.trama= obj.trama || this.trama;
         }
    }
}

