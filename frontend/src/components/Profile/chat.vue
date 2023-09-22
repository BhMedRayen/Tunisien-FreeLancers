<template>
    <div class="container row">
       <div class="liste col-lg-4">
            <div class="text-center" >
                   <v-text-field
                            label="Search User"
                            v-model="search"
                            @change="fetchData()"
                            @keyup="fetchData()"
                            prepend-icon="mdi-magnify"
                    ></v-text-field>
            </div>
            <div >
                <v-radio-group v-model="radioGroup" row class="text-center" wrap   @change="fetchData()" >
             <v-radio 
                 v-for="n in ListRole"
                        :key="n"
                        :label="`${n}`"
                     :value="n"
                ></v-radio>
    </v-radio-group>
            </div>
            <v-card v-if="listUser==''">
                    <v-list-item>
                        <v-list-item-title>
                            NO USERS FOUND <v-icon color="red">mdi-emoticon-cry</v-icon>
                        </v-list-item-title>
                    </v-list-item>
                </v-card>
            <div v-else style="max-height: 700px;scroll-behavior: smooth;overflow-y: scroll;">
                
                <v-card  v-for="user in listUser" @click="choiceUser(user)"
    class="mx-auto mb-4"
    outlined
  >
    <v-list-item three-line :style=" store.User['id']==user.id ? 'background-color:#E84C03;color:#fff' :''">
      <v-list-item-content>
        <div class="text-overline mb-4">
         {{ user.name}}
        </div>
        <v-list-item-title class="text-h5 mb-1">
        {{  user.IsClient ? 'Client' : "Freelancer"}}
        </v-list-item-title>
      </v-list-item-content>

      <v-list-item-avatar
        tile
        size="80"
      >
      <img :src="'http://localhost:8000'+user.Photo">
    </v-list-item-avatar>
    </v-list-item>

   
  </v-card>
            </div>
          
       </div>
       <div class="col-lg-8 col-md-8">
        <div v-if="userContact=='' " class="text-center">
            <p>No User Selected</p>
        </div>
        <v-card v-else class="mt-2" >
            <v-row >
               <v-col>
                  <v-toolbar class="mb-5" >
                      <v-toolbar-title>
                            <img :src="'http://localhost:8000'+userContact.Photo" width="80px" height="50px" alt="logo_app">
                      </v-toolbar-title>
                      <v-spacer></v-spacer>
                    
                        <v-btn plain >
                          {{ userContact.name }}
                        </v-btn>
                     
                   </v-toolbar>
                   <div class="mx-5 px-5" >
                    <div class="chat-boxe" >
                       <div class="chat-areae">
                           <div class="chate"  v-for="chat in chats" :key="chat">
                               <div class="chat-le" v-if="chat.user_send!=store.User['id']">
                                   <div class="mess">
                                       <p>
                                           {{ chat.text }}
                                       </p>
                                       <div class="check">
                                               <span>155</span>       
                                       </div>
                                   </div>
                               </div>
                               <div class="chat-re" v-else>
                                   <div class="sp"></div>
                                   <div class="mess mess-re">
                                       <p>
                                           {{ chat.text }}
                                       </p>
                                       <div class="check">
                                             155
                                       </div>
                                   </div>
                               </div>
                           </div>  
                       </div>
                    </div>
                    <form class="mt-2"  @submit.prevent="addMessage()">
                       <div class="chat-footere">
                           <textarea placeholder="type a message" v-model="message"></textarea>
                           <v-btn class="button ml-5 pa-5 white--text" color="#525fe1" type="submit">Send</v-btn> 
                       </div>
                   </form>
                </div>
                            </v-col>
                            </v-row>
                            </v-card>
                            </div>        
                    
    
      
    </div>
</template>

<style>

.liste {
    border-right: 1px solid #000;
    height: 100vh;
}

</style>
<script>
import {AuthStore} from "../../store/index.js"
import chatService from "../../Services/chat"
export default{
    setup(){
        const store=AuthStore();
        return {store};
    },
    data(){
        return{
            ListRole:['Client',"Freelancer","All"],
            radioGroup:"All",
            search:"",
            listUser:[],
            userContact:[],
            chats:[],
            message:""
        }
    },
    created(){
        this.fetchData();
    },
    methods:{
        fetchData(){
            chatService.getUsers(this.radioGroup,this.search).then((res)=>{
                this.listUser=res.data.data;
            });
        },
        choiceUser(user){
            this.userContact=user;
           chatService.getMessages({
            id:this.userContact.id,
            user_id:this.store.User['id']
           }).then((res)=>{
            this.chats=res.data.data;
           })
        },
        addMessage(){
            chatService.addMessage({
                text:this.message,
                user_id:this.store.User['id'],
                id:this.userContact.id
            }).then((res)=>{
                this.message="";
                this.choiceUser(this.userContact);
            })
        }
    }
}
</script>

<style scoped>

.chat{
    display: flex;
    flex-direction: column;
    height: 100vh;
}
.profil{
    width: 100%;
    background: #000;
    height: 100%;
}

.profil h2{
    display: inline-block;
    line-height: 90px;
    vertical-align: bottom;
    color: #fff;
    margin-left: 50px;
    font-size: 20px;
    font-weight: 600;
}

.chat-box{
    flex: 1;
    background-color:whitesmoke;
    background-attachment: fixed;
    overflow-y: scroll;
    padding: 20px;
}
.chat-footer{
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 60px;
    position: relative;
    cursor: pointer;
}
.chat-footer .text_field{
    display: block;
    flex:1;
    width: 100%;
    border-radius: 60px;
    margin: 5px;
    height: 50px;
    outline: none;
    font-size: 19px;
    padding: 10px;
    padding-left: 40px;
    padding-right:90px ;
    border: 2px solid #ccc;
    background:#fff;
    resize: none;
}

.chat-footer .envoyer{
    display: block;
    width: 35px;
    height: 35px;
    position: absolute;
    left: 10px;
    top: 12px;
}

.chat-boxe .mess{
    width: auto;
    background:#5094df;
    padding: 10px;
    color: #fff;
    border-radius: 10px;
    margin: 20px 0px;
    cursor: pointer;
}
.chat-box .mess{
    background:#5094df;
    padding: 10px;
    color: #fff;
    border-radius: 10px;
    margin: 20px 0px;
    cursor: pointer;
}


.chat-boxe .mess_recu{
    width: auto;
    background:#0c3c70;
    padding: 10px;
    color: #fff;
    border-radius: 10px;
    margin: 20px 0px;
    cursor: pointer;
}
.chat-box .mess p{
    word-break: break-all;
    font-size: 18px;
}

*::-webkit-scrollbar{
    width: 5px;
}
*::-webkit-scrollbar-track{
    background-color: #f1f1f1;
}
*::-webkit-scrollbar-thumb{
    background-color: #aaa;
}
*::-webkit-scrollbar-thumb:hover{
    background-color: #555;
}

@media screen and (max-width:400px){
    .container{
        width: 100%;
    }
}


.containere{
    width: 500px;
    margin: auto;
}
.chate{
    display: flex;
    flex-direction: column;
    background: white;
}
.chat-headere{
    display: flex;
}
.profile{
    width: 100%;
    background: rgb(77, 96, 192);
    display: flex;
    align-items: center;
    height: 60px;
    padding: 0px 10px;
    position: relative;
}
.profile .cs{
    display: block;
    width: 40px;
    position: absolute;
    top: 12px;
    cursor: pointer;
    border-radius: 20px;
}
.profile h2{
    display: inline-block;
    line-height: 90px;
    vertical-align: bottom;
    color: #fff;
    margin-left: 50px;
    font-size: 20px;
    font-weight: 600;
}
.profile span{
    color: #ccc;
    position: absolute;
    top: 42px;
    left: 70px;
    font-size: 14px;
}
.profile .left{
    flex: 1;
}
.righte .icon{
    display: inline-block;
    width: 25px;
    margin-left: 8px;
}
.chat-areae{
    overflow-y: scroll;
    height:70vh;
}
.chat-boxe{
    flex: 1;
    color:#000 !important;
    /* background-image: url(../../../../public/etudiant/images/chat/bg.jpeg); */
    padding-left: 20px;
}
.chat-footere{
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 60px;
    position: relative;
    cursor: pointer;
}
.chat-footere textarea{
    display: block;
    flex:1;
    width: 100%;
    border-radius: 60px;
    margin: 5px;
    height: 50px;
    outline: none;
    font-size: 19px;
    padding: 10px;
    padding-left: 40px;
    padding-right:90px ;
    border: 2px solid #ccc;
    color: #555;
    resize: none;
}
.chat-footere .mic{
    display: block;
    width: 45px;
    height: 45px;
    margin-top: -3px;
    margin-right: 18px;
}
.chat-footere .emo{
    display: block;
    width: 35px;
    height: 35px;
    position: absolute;
    left: 10px;
    top: 12px;
}
.chat-footere .icons{
    position: absolute;
    right: 100px;
    top: 10px;
}
.chat-footere .icons img{
    display: inline-block;
    width: 35px;
    height: 35px;
}
.chat-re{
    display: flex;
}
.chat-re .sp{
    flex: 1;
}
.chat-le{
    display: flex;
}
.chat-le .sp{
    flex: 1;
}
.chat-boxe .mess{
    max-width: 300px;
    background-color: #f7fcf6;
    padding: 10px;
    color:#000 !important;
    border-radius: 10px;
    margin: 20px 0px;
    cursor: pointer;
}
.chat-boxe .mess p{
    word-break: break-all;
    font-size: 18px;
    color:#000 !important;
}
.chat-boxe .mess-r{
    background: #e2ffc7;
}
.chat-boxe .emoji{
    width: 20px; 
}
.chat-boxe .check{
    float: right;
}
.chat-boxe .check img{
    width: 20px;
}
.chat-boxe .check span{
    color: #888;
    font-size: 12px;
    font-weight: 700px;
}



</style>