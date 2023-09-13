<template>
    <div>     
        <v-container fluid fill-height>
                <v-layout class="mt-5 py-5" align-center justify-center>
                   <v-flex  sm8 md4>
                      <v-card class="elevation-12">
                         <v-toolbar dark color="#E84C03">
                            <v-toolbar-title >
                               <div class="d-flex justify-content-center mt-5">
                                   <p>S'incrire</p>
                               </div>
                            </v-toolbar-title>
                         </v-toolbar>
                         <v-card-text>
                         <form @submit.prevent="Register()"  enctype="multipart/form-data">
                              <div class="row">
                                 <div class="col-md-6">
                                  <v-text-field
                                  name="Name"
                                  label="Nom"
                                  v-model="nom"        
                                  type="text"
                                  placeholder="Tapez Nom"
                                ></v-text-field>    
                                 </div>
                                 <div class="col-md-6">
                                  <v-text-field
                                  name="LastName"
                                    v-model="prenom"
                                  label="Prenom"       
                                  type="text"
                                  placeholder="Tapez Prenom"
                                ></v-text-field>
                                 </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                 <v-text-field
                                    v-model="email"
                                 name="Email"
                                 label="Email"
                                 type="text"                            
                                 placeholder="Entrer Email"
                               ></v-text-field>                       
                                </div>
                             </div>
                             <v-radio-group v-model="sex">
      <v-radio
        label="Homme"
        value="man"
      ></v-radio>
      <v-radio
        label="Femme"
        value="woman"
      ></v-radio>
    </v-radio-group>
                             <div class="row">
                              <div class="col-md-12">
                                <v-text-field                    
                                  name="password"
                                v-model="password"
                                  :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                                  :type="show ? 'text' : 'password'"
                                  @click:append="show = !show"              
                                  label="Mot de passe"               
                                  placeholder="Mot de passe"
                               ></v-text-field>
                              </div>
                           </div>
                           <div class="row">
                            <div class="col-md-12">
                              <input   
                                   class="form-control"
                                   type="file" ref="photo"
                                   @change="uploadFile"
                              >   
                            </div>       
                            <div class="col-md-12">
                             <v-text-field
                             name="N° Phone"
                             label="N° Télephone"
                            v-model="tlf"
                           
                             type="text"
                             placeholder="+216"
                           ></v-text-field>
                            </div>
                            <div class="col-md-12">
                             <v-text-field
                             name="Cin"
                             label="Cin"
                             v-model="cin"
                             type="text"
                             placeholder="Cin"
                           ></v-text-field>
                            </div>
                         </div>
                         <v-radio-group v-model="role" @change="ShowDilaog()">
      <v-radio
        label="Client"
        value="Client"
      ></v-radio>
      <v-radio
        label="Freelancer"
        value="Freelancer"
      ></v-radio>
    </v-radio-group>
                        <v-checkbox>
                          <template v-slot:label>
                            <div>
                           je suis d'accord avec le
                              <span style="color:blue"> Termes et conditions </span>  
                                est génial
                            </div>
                            <div>
                             
                            </div>
                          </template>
                      
                        </v-checkbox> 
                        <div>
                        </div>
                                <div class="mt-3 text-center ">
                                    <v-btn :loading="load" type="submit" class="mt-4 " style="color:#fff !important" color="#E84C03" value="Sign Up">S'incrire</v-btn>
                                    <router-link to="/" class="text-decoration-none  mx-2"> <v-btn type="button" class="mt-4 " color="gray" value="close">Fermer</v-btn></router-link>
                                </div>
                                <div class="text-center mt-3">
                                  Vous avez déjà un compte ?<router-link to="login" class="text-decoration-none  mx-2">  <span>Connexion</span></router-link>
                                </div>
                          </form>
                         </v-card-text>
                      </v-card>
                   </v-flex>
                </v-layout>
             </v-container>
             <v-dialog
      v-model="dialog"
      persistent
      max-width="600px"
    >
      <v-card v-if="showService">
        <v-card-title>
          <span class="text-h5">All Services</span>
          <v-spacer></v-spacer>
            <v-btn @click="showService=false">Added Other Services</v-btn>
        </v-card-title>
        <v-card-text>
            <div v-if="services==''">
                <p>NO SERVICE YET</p>
            </div>
           <div v-else>          
            <v-card
    class="mx-auto mb-2"
    v-for="service in services"
    max-width="344"
  >
    <v-card-text>
      <div>Years of Service {{ service['Years'] }}</div>
      <p class="text-h4 text--primary">
        {{ service['Name'] }}
      </p>
      <p style="font-weight:600">Type</p>
      <div class="text--primary">
          {{ service['Type'] }}
        <br>
        <span style="font-weight:600">Price</span> {{ service['price'] }} TND
      </div>
    </v-card-text>
    <v-card-actions>
      <v-btn
        text
        color="yellow"
        @click="EditService(service['id'])"
      >
        Edit
      </v-btn>
      <v-btn
        text
        color="red"
        @click="DeleteService(service['id'])"
      >
        Delete
      </v-btn>
    </v-card-actions>
    </v-card>
           </div>
        </v-card-text>
      </v-card>
      <v-card v-else>
        <v-card-title v-if="showUpdate==false">
          <span class="text-h5">Services</span>
          <v-spacer></v-spacer>
            <v-btn @click="showService=true">Show Service {{ services.length }}</v-btn>
        </v-card-title>
        <v-card-title v-else>
          <span class="text-h5">Update</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-alert
            v-if="alert"
  color="red"
  type="success"
>
            All Filds Are Required
</v-alert>
            <v-row>
              <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                  label="Name Service"
                  v-model="nameService"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                  label="Years Of Expercience"
                  v-model="YearsExp"
                  hint="Enter Number"
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                  label="TypeService"
                  hint="Type"
                  v-model="typeServ"
                  persistent-hint
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                  label="Price of Service"
                  hint="TND"
                  v-model="PriceService"
                  persistent-hint
                  required
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions v-if="showUpdate==false">
          <v-spacer></v-spacer>
          <v-btn
            color="black darken-1"
            text
            @click="dialog = false"
          >
            Close
          </v-btn>
          <v-btn
            color="blue darken-1"
            type="submit"
            text
            @click="AddService()"
          >
            Add
          </v-btn>
          <v-btn
            color="green"
            text
            @click="dialog = false"
          >
            Terminer
          </v-btn>
        </v-card-actions>
        <v-card-actions v-else>
            <v-btn text color="black" @click="showUpdate=false;showService=true">
                Close
            </v-btn>
            <v-btn text color="yellow" @click="UpdateService()">
                Edit
            </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
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
import Sevice from "../../Services/auth.js"
export default{
    data(){
        return{
                load:false,
                show:false,
                nom:"",
                prenom:"",
                email:"",
                password:"",
                sex:"",
                cin:"",
                tlf:"",
                role:"",
                image:"",
                dialog:false,
                services:[],
                nameService:"",
                YearsExp:"",
                PriceService:"",
                typeServ:"",
                snackbar:false,
                text:"",
                alert:false,
                showService:false,
                showUpdate:false,
                idService:""
        }
    },
    methods:{
        uploadFile(){
            this.image=this.$refs.photo.files[0];
            console.log(this.image);
        },
        Register(){
            this.load=true;
            Sevice.CreateUser(
                {
                    nom:this.nom,
                    email:this.email,
                    prenom:this.prenom,
                    sex:this.sex,
                    password:this.password,
                    cin:this.cin,
                    services:JSON.stringify(this.services),
                    tlf:this.tlf,
                    photo:this.image,
                    ClientChoice:this.role
                }
            ).then((res)=>{
                this.load=false;
                console.log(res);
            }).catch((error)=>{
                this.load=false;
            })
        },
        AddService(){
            if(this.nameService=="" || this.PriceService=="" || this.typeServ=="" || this.YearsExp=="" ){
                this.alert=true;
                setTimeout(()=>this.alert=false,3000);
                return;
            }
            let id=Math.random(9999);
            this.services.push(
                {
                    "id":id,
                    "Name":this.nameService,
                    "price":this.PriceService,
                    "Type":this.typeServ,
                    "Years":this.YearsExp
                }
            )
            this.snackbar=true;
                this.text=this.nameService +"Added With Success";
            setTimeout(() => {
                this.snackbar=false;
                this.text="";
            }, 3000);
            this.nameService="";
            this.PriceService="";
            this.typeServ="";
            this.YearsExp="";
        },
        ShowDilaog(){
            if(this.role=="Freelancer"){
                this.dialog=true;
            }
        },
        DeleteService(id){
            let Indexservice=this.services.findIndex((res)=>res.id==id);
            this.services.splice(Indexservice,1);
        },
        EditService(id){
            let Indexservice=this.services.findIndex((res)=>res.id==id);
            this.nameService=this.services[Indexservice].Name;
            this.PriceService=this.services[Indexservice].price;
            this.YearsExp=this.services[Indexservice].Years;
            this.typeServ=this.services[Indexservice].Type;
            this.idService=id;
            this.showUpdate=true;
            this.showService=false;
        },
        UpdateService(){
            let Indexservice=this.services.findIndex((res)=>res.id==this.idService);
            this.services[Indexservice].Name=this.nameService;
            this.services[Indexservice].price=this.PriceService;
            this.services[Indexservice].Years=this.YearsExp;
            this.services[Indexservice].Type=this.typeServ;
            this.showService=true;
            this.showUpdate=false;
            this.nameService="";
            this.PriceService="";
            this.YearsExp="";
            this.typeServ="";
            this.idService="";
            this.text="Updated with Sucess";
            this.snackbar=true;
        }

    },
    computed:{

    }
}
</script>