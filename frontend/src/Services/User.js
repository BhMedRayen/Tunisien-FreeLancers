import "@/plugins/axios";
import Axios from "axios";
export default{
    editUser(Info,id){
        let data=new FormData();
        data.append("photo",Info.photo);
        data.append("name",Info.nom);
        data.append("lastname",Info.prenom);
        data.append("password",Info.password);
        const config={
            Headers:{
                "content-Type":'multipart/form-data',
            },
        };
        return Axios.post("user/user_update/"+id,data,config);
    }

}