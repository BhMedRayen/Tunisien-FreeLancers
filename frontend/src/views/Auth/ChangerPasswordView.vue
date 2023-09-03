<template>

                <v-container fluid fill-height>
                    <v-layout align-center justify-center>
                       <v-flex xs12 sm8 md4>
                          <v-card class="elevation-12">
                             <v-toolbar dark color="#E84C03">
                                <v-toolbar-title >Changer Mot de passe</v-toolbar-title>
                             </v-toolbar>
                             <v-card-text>
                             <form  @submit.prevent="changer_password()">
                                    <v-text-field
                                      v-model="email"
                                    
                                      name="email"
                                      label="Email"
                                      type="text"
                                      placeholder="Entrer Email"
                                    ></v-text-field>
                                   
                                  
                                    <v-text-field
                                    v-model="password"
                                  
                                    name="password"
                                    label="Mot de passe"
                                    type="password"
                                    placeholder="Entrer Mot de passe"
                                  ></v-text-field>
                                 
                                  <v-text-field
                                        name="Confirme"
                                       
                                        label="Confirme Password"
                                        type="password"
                                        v-model="confirme"
                                        placeholder="Entrer Confirme Mot de passe"
                                  ></v-text-field>
                                    <div class="mt-3 text-center">
                                           <v-btn :loading="load" type="submit" class="mt-4 mx-2" style="color:#fff !important" color="#E84C03" >
                                              Changer
                                            </v-btn>
                                        <v-btn @click="refresh()" type="button" class="mt-4 " color="gray" value="log in">Fermer</v-btn>
                                    </div>
                              </form>
                             </v-card-text>
                          </v-card>
                       </v-flex>
                    </v-layout>
                    <v-snackbar
                 v-model="snackbar"
               >
                 {{ text }}
           
                 <template v-slot:action="{ attrs }">
                   <v-btn
                     color="green"
                     text
                     v-bind="attrs"
                     @click="snackbar = false"
                   >
                     Close
                   </v-btn>
                 </template>
               </v-snackbar>
                 </v-container>

</template>

<script>

  import auth from '@/Services/auth';

    export default{
        name:"changer_password",
      
       
        data(){
            return{
             email:'',
             password:'',
             text:"",
             confirme:'',
           
             snackbar:false,
             load:false
            }
        },
        methods:{
            changer_password(){
              if(this.password==this.confirme){
                auth.changerPassword({
                email:this.email,
                password:this.password
              }).then((res)=>{
                this.$router.push({name:"login",query: {content: res.data.data}});
              }).catch((error)=>{
                console.log(error);
              })
              }else{
                this.snackbar=true;
                this.text="confirme mot de passe doit étre identique que le mot de passe"
              }
            
            }
          
        },
        components:{
    
},
        computed:{
    
        }
    }
</script>

<style scoped>



</style>