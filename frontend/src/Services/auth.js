import "@/plugins/axios";
import Axios from "axios";
import { AuthStore } from "@/store";
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
    },
    async Login(email,password){
        const store=AuthStore();
        const res =await Axios.post("auth/login",{email,password});
        if(res.status==200){
            const dataInfo=res.data.data;
            store.login(dataInfo.token,dataInfo.user,dataInfo.Role=="Client" ? true :false);
        }else{
            store.LogOut();
        }
     
    },
    forgetpassword(email)
    {
        return Axios.post('auth/forgotPasswordToken/'+email);
    },
    VerifyToken(data){
        return Axios.post("auth/VerifyToken",data);
    },
    changerPassword(data){
        return Axios.post("auth/ChangerPassword",data);
    }

}