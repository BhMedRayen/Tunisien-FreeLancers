<template>
    <div>
      <navbar class="mb-5"></navbar>
      <div>
                <v-container fluid fill-height style="margin-top: 8%;">
                    <v-layout align-center justify-center>
                       <v-flex xs12 sm8 md4>
                          <v-card class="elevation-12">
                             <v-toolbar dark color="#E84C03">
                                <v-toolbar-title >Mot de passe oublié</v-toolbar-title>
                             </v-toolbar>
                             <v-card-text>
                             <form  @submit.prevent="VerifyToken()">
                              <v-text-field
                                      v-model="email"
                                     
                                      name="email"
                                      label="Email"
                                      type="text"
                                      placeholder="Entrer Email"
                                    ></v-text-field>
                                <v-otp-input
                                      v-model="code"
                                      
                                        type="number"
                                        length="4"
                                        color="#E84C03"
                                    ></v-otp-input>
                                    <div class="mt-3 text-center">
                                           <v-btn :loading="load" type="submit" class="mt-4 mx-2" style="color:#fff !important" color="#E84C03" value="log in">
                                              Confirmer
                                            </v-btn>
                                        <router-link to="login"><v-btn  type="button" class="mt-4 " color="gray" value="log in">Fermer</v-btn></router-link>
                                    </div>
                              </form>
                             </v-card-text>
                          </v-card>
                       </v-flex>
                    </v-layout>
                    <v-snackbar v-model="snackbar">
                                {{ text }}
                                
      <template v-slot:action="{ attrs }">
        <v-btn color="pink" text v-bind="attrs" @click="snackbar = false">
          Close
        </v-btn>
      </template>
    </v-snackbar>
</v-container>
</div> 
    </div>
</template>

<script>
  import auth from '@/Services/auth';
  import navbar from '@/components/Home/navbar.vue';
    export default{
        name:"VerifyToken",
        
        data(){
            return{
                code:'',
             snackbar:false,
             load:false,
             text:"",
             email:""
            }
        },
        methods:{
            VerifyToken(){
                auth.VerifyToken({token:this.code,email:this.email}).then((res)=>{
                    this.$router.push("chnagerPass");
                }).catch((error)=>{
                     this.snackbar=true;
                     this.text=error.response.data.data;
                })
            }
        },
        computed:{
          
        },
        components:{
          navbar
        },

    }
</script>

<style scoped>
</style>