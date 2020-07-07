/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
export class guest {
    public email: string="";
    public password: string="";
    
        constructor(obj?: any) {
        this.setObj(obj);
    }
    
    setObj(obj?: any) {
        if (obj) {
            this.email = obj.email || this.email;
            this.password = obj.password || this.password;
         }
}
}

