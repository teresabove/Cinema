/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 */
 
export class profilo{
    public nome: string= "";
    public cognome: string ="";
    public datadinascita: string ="";
    public indirizzo: string="";
    public citta: string="";
    public telefono: string="";
    public a_listasconti: string="";
    public idutente: string ="";
    
       constructor(obj?: any) {
        this.setObj(obj);
    }
    
        setObj(obj?: any) {
        if (obj) {
            this.nome = obj.nome || this.nome;
            this.cognome = obj.cognome || this.cognome;
            this.datadinascita = obj.datadinascita || this.datadinascita;
            this.indirizzo = obj.indirizzo || this.indirizzo;
            this.citta= obj.citta || this.citta;
            this.telefono= obj.telefono || this.telefono;
            this.a_listasconti= obj.a_listasconti || this.a_listasconti;
            this.idutente = obj.idutente || this.idutente;
         }
    }
    
}
