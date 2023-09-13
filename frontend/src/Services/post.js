import "@/plugins/axios";
import Axios from "axios";

export default{
    AddPostFn(info){
        return Axios.post("post/AddPOST",info);
    } ,
    getPosts(){
        return Axios.get("post/getPosts");
    },
    deletepost(id){
        return Axios.delete("post/deletPost/"+id);
    },
    updatepost(info){
        return Axios.put("post/updatepost",info);
    }
}
     
