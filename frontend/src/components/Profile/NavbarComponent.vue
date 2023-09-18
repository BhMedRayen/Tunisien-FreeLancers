<template>
    <div>
        <v-app-bar
            color="white"
       >
      <v-toolbar-title @click="ChangeSettiing()">
         <img src="../../assets/logo/TF.png" width="100px">
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <div class="d-flex ">
        <v-btn class="mx-4" color="#E84C03" >
          <v-icon color="white" @click="editPageAccueil(true)">mdi-home</v-icon>
        </v-btn>
        <v-btn class="mx-4"  color="#E84C03">
          <v-icon color="white"  @click="editPageAccueil(false)">mdi-account</v-icon>
        </v-btn>
      </div>
            <v-spacer></v-spacer>

      <v-menu offset-y
               
               transition="slide-x-transition" 
               left
               class="mt-7"
               max-width="auto"
               min-width="300"
               >
               
                   <template v-slot:activator="{ on, attrs }">
                    <v-btn
                    plain
                    v-bind="attrs"
                    v-on="on"
                    >
                       <v-icon color="red" size="35px ">mdi-bell</v-icon>
                     <v-badge color="red" :content="notifications.length==0 ? '0' : notifications.length"
                       ></v-badge>
                    </v-btn>
                   </template>
                      <v-list>
                           <v-list-item class="text">
                               Notifications
                           </v-list-item>
                       </v-list>
                       <v-divider></v-divider>
                   <v-list v-if="notifications==''">
                   <v-list-item  class="mt-5 red--text">
                       <v-list-item-title class="text-h7 ml-8 mb-8">No notifications is available</v-list-item-title>
                   </v-list-item>
                  </v-list>
                   <v-list v-else>
                   <v-list-item
                      v-for="notif in notifications" :key="notif.id" 
                   >
                       <v-list-item-content>
                           <v-list-item-title class="px-5 justify-center">
                             {{ notif.message }}  
                           </v-list-item-title>
                       </v-list-item-content> 
                       <v-list-item-action>
                           <v-col cols="auto">
                                <v-btn
                                 color="red"
                                 plain
                                   @click="deleteNotificationById(notif.id)"
                                   >
                                       <v-icon>mdi-delete</v-icon>
                                   </v-btn>
                           </v-col>
                       </v-list-item-action>
                   </v-list-item>
                       <v-divider></v-divider>
                   </v-list>
               </v-menu>
    <v-menu class="mx-4"
      :rounded="rounded"
       offset-y
      :nudge-width="100"
    >
      <template v-slot:activator="{ attrs, on }">
        <v-list-item-avatar  v-bind="attrs"
          v-on="on">
               <v-avatar size="43px">
                      <v-img  :src="'http://localhost:8000'+User['Photo']"></v-img>
                </v-avatar>
       </v-list-item-avatar>
       
      </template>

      <v-list>
       
        <v-list-item @click="ChangeSettiing()"
        >
        
            <v-list-item-content >
              <v-list-item-title>Settings</v-list-item-title>
            </v-list-item-content>
            <v-list-item-action>
              <v-btn text
              >
                <v-icon>mdi-cog</v-icon>
              </v-btn>
            </v-list-item-action>
        
        </v-list-item>
        <v-list-item @click="logout()"
        >
        
            <v-list-item-content>
              <v-list-item-title>Logout</v-list-item-title>
            </v-list-item-content>
            <v-list-item-action>
              <v-btn text
              >
                <v-icon>mdi-logout</v-icon>
              </v-btn>
            </v-list-item-action>
        
        </v-list-item>
      </v-list>
    </v-menu>
 
    </v-app-bar>
    </div>
</template>

<script>
import notiifSerice from "../../Services/Notif.js"
import {AuthStore} from "../../store/index"
export default{
  created(){
    this.getNotifs();
  },
    mounted(){
        this.User=this.store.getUser;
    },

    setup(){
        const store=AuthStore();
        return{store}
    },  
    data(){
        return{
            User:[],
            Roles:["Client","Freelancer"],
            roleSlelected:"",
            search:"",
            errorSearch:"",
            notifications:[]
        }
    },
    methods:{
      getNotifs(){
        notiifSerice.getNotif(this.store.User['id']).then((res)=>{
          this.notifications=res.data.data;
        })
      },
      deleteNotificationById(id){
        notiifSerice.deleteNotif(id).then((res)=>{
          this.getNotifs();
        });
      },
      editPageAccueil(val){
        this.$emit('editPageAccueil',val);
      },
      logout(){
        this.store.LogOut();
        this.$router.push({name:'login'});
      },
      ChangerRoleSelected(val){
        this.roleSlelected=val;
      },
      FetchData(){
        if(this.roleSlelected==""){
          this.errorSearch="Chose Role";
        }
      },
      ChangeSettiing(){
          this.$emit('ChangeSettiing');
      }
    }
}

</script>