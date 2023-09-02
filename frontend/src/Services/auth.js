import "@/plugins/axios";
import Axios from "axios";

export default{

    
    CreateUser(info){
        let data=new FormData();
        data.append("name",info.nom);
        data.append("email",info.email);
        data.append("lastname",info.prenom);
        data.append("sex",info.sex);
        data.append("password",info.password);
        data.append("cin",info.cin);
        data.append("num_tlf",info.tlf);
        data.append("Services",info.services);
        data.append("photo",info.photo);
        data.append("ClientChoice",info.ClientChoice);
        const config={
            Headers:{
                "content-Type":'multipart/form-data',
            },
        };
        return Axios.post("auth/register",data,config);
    },
    verify(email){
        return Axios.post("auth/verify/"+email);
    }
}