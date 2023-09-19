import "@/plugins/axios";
import Axios from "axios";

export default{
    AddSKill(info){
        return Axios.post("skill/AddSkill",info);
    },
    deleteSkill(id){
        return Axios.delete("skill/DeleteSkill/"+id);
    },
    updateSkill(id,info){
        return Axios.put("skill/UpdateService/"+id,info);
    },
    getSkills(id){
        return Axios.get("skill/getSkills/"+id);
    }
}