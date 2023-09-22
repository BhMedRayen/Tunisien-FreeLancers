
import "@/plugins/axios"
import Axios from "axios"

export default{
    getUsers(radio,search){
        return Axios.get(`chat/GetUser?radio=${radio}&${search ? "search="+search : ""}`);
    },
    getMessages(data){
        return Axios.get("chat/getMessages/"+data.id+"/"+data.user_id);
    },
    addMessage(info){
        return Axios.post("chat/addMessage",info);
    }
}