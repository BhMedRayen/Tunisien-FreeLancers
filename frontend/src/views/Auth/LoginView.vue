<template>
         <v-container fluid fill-height>
                    <v-layout align-center justify-center>
                       <v-flex xs12 sm8 md4>
                          <v-card class="elevation-12">
                             <v-toolbar dark color="#E84C03">
                                <v-toolbar-title >Content de te revoir</v-toolbar-title>
                             </v-toolbar>
                             <v-card-text>
                             <form >
                             
                            

                                    <v-text-field
                                  
                                    
                                      name="email"
                                      label="Email"
                                   
                                      type="text"
                                      placeholder="Enter Email"
                                    ></v-text-field>
                                    <v-text-field
                                      :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                                    
                                      name="password"
                                      label="Mot de passe"
                                      :type="show ? 'text' : 'password'"
                                     
                                      @click:append="show = !show"
                                      placeholder="password"
                                   ></v-text-field>
                                    <div class="mt-3 text-center">
                                        <v-btn type="submit" class="mt-4 mx-2" style="color:#fff !important" color="#E84C03" value="log in" :loading="load">Connexion</v-btn>
                                        <v-btn type="button" class="mt-4 " color="gray" value="log in">Fermer</v-btn>
                                        <div class="text-center mt-3">
                                          Vous êtes nouveau ici ?<router-link to="signup" class="text-decoration-none  mx-2">  <span>S'incrire</span></router-link>
                                        </div>
                                        <div class="text-center mt-3">
                                          <router-link to="forgot_password" class="text-decoration-none  mx-2">Mot de passe oublié ?</router-link>
                                        </div>
                                    </div>
                              </form>
                           
                             </v-card-text>
                          </v-card>
                       </v-flex>
                    </v-layout>
                 
                 </v-container>
</template>

<script>
import serviceauth from "../../Services/auth.js";
export default{
    created(){
        if(this.$route.query.email!='undefined'){
             this.verifyEmail();
        }
    },
    data(){
        return{
            show:false
            
        }
    },
    methods:{
        verifyEmail(){
            console.log("test")
            serviceauth.verify(this.$route.query.email).then((res)=>{

            })
        }
    }
}
</script>