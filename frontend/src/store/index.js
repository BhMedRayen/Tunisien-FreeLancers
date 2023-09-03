import { ref,computed } from "vue"
import { defineStore } from "pinia";

export const AuthStore = defineStore('auth', () => {
  const token=ref(localStorage.getItem("token")??null);
  const User=ref(JSON.parse(localStorage.getItem("user"))??null);
  const isAuth=ref(localStorage.getItem("token")&&localStorage.getItem("user"));
  const IsClient=ref(localStorage.getItem("IsClient"));

  const getToken=computed(()=>token.value);
  const getUser=computed(()=>User.value);
  const getIsAuth=computed(()=>isAuth.value);
  const getIsClient=computed(()=>IsClient.value);


  function login(t,u,isCl){
    token.value=t;
    User.value=u;
    isAuth.value=true;
    IsClient.value=isCl;
    localStorage.setItem("user",JSON.stringify(u));
    localStorage.setItem("token",t);
    localStorage.setItem("isauth",true);
    localStorage.setItem("IsClient",isCl);
  }

  function LogOut(){
    token.value=null;
    User.value=null;
    isAuth.value=false;
    IsClient.value=null;
    localStorage.removeItem("user");
    localStorage.removeItem("token");
    localStorage.removeItem("isauth");
    localStorage.removeItem("IsClient");
  }

  return{
    token,
  User,
isAuth,
IsClient,
getToken,
getUser,
getIsAuth,
getIsClient,
login,
LogOut
  }
})