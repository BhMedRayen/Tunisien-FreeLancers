<template>
         <div>
                <navbar class="mb-5"></navbar>
                  <v-container fluid fill-height style="margin-top:7%;" data-aos="fade-left">
                    <v-layout align-center justify-center>
                       <v-flex xs12 sm8 md4>
                          <v-card class="elevation-12">
                             <v-toolbar dark color="#E84C03">
                                <v-toolbar-title >Happy to see you again</v-toolbar-title>
                             </v-toolbar>
                             <v-card-text>
                             <form @submit.prevent="login()">   
                              <v-alert
                                 v-if="message!=''"
                                  type="success"
                                >
                                  {{ message }}
                              </v-alert>                   
                                    <v-text-field
                                      name="email"
                                      label="Email"
                                    v-model="email"
                                      type="text"
                                      placeholder="Enter Email"
                                    ></v-text-field>
                                    <v-text-field
                                      :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                                      name="password"
                                      label="Password"
                                      :type="show ? 'text' : 'password'"
                                      v-model="password"
                                      @click:append="show = !show"
                                      placeholder="password"
                                   ></v-text-field>
                                    <div class="mt-3 text-center">
                                        <v-btn type="submit" class="mt-4 mx-2" style="color:#fff !important" color="#E84C03" value="log in" :loading="load">Connexion</v-btn>
                                        <router-link to="/" class="text-decoration-none  mx-2"> <v-btn type="button" class="mt-4 " color="gray" value="close">Close</v-btn></router-link>
                                        <div class="text-center mt-3">
                                          Are you new here?<router-link to="signup" class="text-decoration-none  mx-2">  <span>Sign up</span></router-link>
                                        </div>
                                        <div class="text-center mt-3">
                                          <router-link to="ForgotPassword" class="text-decoration-none  mx-2">Forgot password ?</router-link>
                                        </div>
                                    </div>
                              </form>
                             </v-card-text>
                          </v-card>
                       </v-flex>
                    </v-layout>
                  </v-container>
                    <v-snackbar
      v-model="snackbar"
    >
      {{ text }}

      <template v-slot:action="{ attrs }">
        <v-btn
          color="pink"
          text
          v-bind="attrs"
          @click="snackbar = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>
  </div>
    
</template>

<script>
import { AuthStore } from "@/store";
import serviceauth from "../../Services/auth.js";
import navbar from "@/components/Home/navbar.vue";
export default{
  setup(){
    const store=AuthStore();
    return {store}
  },
    created(){
        if((this.$route.query.email)?.length>5){
             this.verifyEmail();
        }
        if(this.$route.query.content){
            this.message=this.$route.query.content;
            setTimeout(()=>{this.message="",3000;this.$router.replace({'query':null});});
        }

        if((this.$route.query.content)?.length>2){
          this.snackbar=true;
          this.text=this.$route.query.content;
        }
    },
    data(){
        return{
            show:false,
            email:"",
            password:"",
            load:false,
            text:"",
            snackbar:false,
            message:""
            
        }
    },
    methods:{
        verifyEmail(){
              serviceauth.verify(this.$route.query.email).then((res)=>{
            })
        },
        login(){
          this.load=true;
          serviceauth.Login(this.email,this.password).then((res)=>{
             this.$router.push({name:"profile"});
            this.load=false;
          }).catch((error)=>{
            this.load=false;
            this.text=error.response.data.message;
            this.snackbar=true;
          })
        }
    },
    components:{
      navbar
    }
}
</script>