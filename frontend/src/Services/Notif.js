import "@/plugins/axios";
import Axios from "axios";

export default{
    getNotif(id){
        return Axios.get("notif/getNotification/"+id);
    },
    deleteNotif(id){
        return Axios.delete("notif/DeleteNotif/"+id);
    }
}