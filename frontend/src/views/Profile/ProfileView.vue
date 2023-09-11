<template>
            <div>
                <NavbarComponent @ChangeSettiing="ChangeSettiing"></NavbarComponent>
                <div v-if="!setting" >
                <div class="mt-5 py-5 container">
                    <v-card
                    max-width="100%"
                    elevation="7"
                    outlined
  >
    <v-list-item three-line>
      <v-list-item-content>
        
        <v-list-item-title class="text-h5 mb-1">
            <div style="display:flex;align-items:center;gap:30px">
                <div>
                    <v-avatar size="150">
                      <v-img  :src="'http://localhost:8000'+User['Photo']"></v-img>
                </v-avatar>
                </div>
                <div class="text-center py-4">
                    <p>{{ User['name'] }}</p>
                    <p> {{ User['lastName'] }}</p>
                    <p style="color:#E84C03">  {{ User['IsClient'] ? 'Client ' : 'Freelancer' }}</p>
                </div>
            </div>           

        </v-list-item-title>
           </v-list-item-content>
           <v-spacer></v-spacer>
           <v-btn
        outlined
        rounded
        text
        color="#E84C03"
      >
        Edit Profile
      </v-btn>
    </v-list-item>
  
  </v-card>
                </div>
                <div class="row container-fluid " style="margin:25px !important" >
                   
                        <div class="col-lg-4 text-center" >
                            <v-card elevation="5">
                            <p style="color:#E84C03">Contact</p>
                            <div>
                                {{ User['email'] }}
                            </div>
                            <div>
                                {{ User['num_tlf'] }}
                            </div>
                            <div>
                                <img width="150px" height="150px" src="../../assets/Code typing-rafiki.png">
                            </div>
                        </v-card>
                        </div>
                        <div class="col-lg-8">
                            <v-card elevation="5">
                                <div style="height: 300px; overflow-y: scroll;">
                                    test
                                </div>
                            </v-card>
                      </div>
                </div>
            </div>  
               <div v-else>
                <SettingComp></SettingComp>
               </div>
              
            </div>
</template>

<script>
import SettingComp from "../../components/Profile/Settings"
import {AuthStore} from "../../store/index"
import NavbarComponent from "../../components/Profile/NavbarComponent"
export default{

    created(){
        this.User=this.setup.getUser;
    },

    setup(){
        const setup=AuthStore();
        return{setup}
    },  
    data(){
        return{
            User:[],
            setting:false
        }
    },
    methods:{
        ChangeSettiing(){
           this.setting=!this.setting;
        }
    },
    components:{
        NavbarComponent,SettingComp
    }
}

</script>