<template>
        <div class="d-flex p-3 mt-5 m-4 justify-content-center">   
    <div class="col-xl-10 col-md-8 container">
          <div class="row shadow-lg rounded">
                <div class="col-lg-6">
                        <div class="text-center">
                           <h1 class="h4 fw-bolder mb-3 py-3">Setting</h1>
                        </div>
                    <form @submit.prevent="Setting()" class="py-4"  method="POST"  enctype="multipart/form-data">
                 
                   
                       <div class="row mb-4 ">
                          <div class="col-lg-6">
                            <v-text-field
          class="pt-2"
            label="Nom"
                            v-model="name"
            filled
          ></v-text-field>
                           
                          </div>
                          <div class="col-lg-6">
                            <v-text-field
          class="pt-2"
            label="LastName"
            v-model="lastName"
            filled
          ></v-text-field>
                          </div>
                        </div>
                        <div class="row mb-4">
                          <div class="col-lg-12 mb-3">
                            <v-text-field
          class="pt-2"
            label="Password"
            v-model="password"  
            filled
          ></v-text-field>
                          </div>
                          <div class="col-lg-12">
                        
                            <v-text-field
          class="pt-2"
            label="Confirm Password"
            v-model="confirm"  
            filled
          ></v-text-field>
                    </div>
                      </div>
                        <div class="row">
                          <div class="col-lg-12">
                            <v-avatar size="43px">
                                 <v-img  :src="'http://localhost:8000'+photo"></v-img>
                            </v-avatar>
                            <input @change="changePhoto()" ref="photo" type="file" name="avatar" class="form-control ">
                            <small class="text-danger" ></small>
                          </div>
                        </div>
                        <div class="text-center mt-2">
                             <v-btn type="Submit" color="#E84C03" style="color:#fff">Edit</v-btn>
                        </div>
                      
                    </form>
                </div>
                <div class="col-lg-6 d-none d-lg-block ">
                    <img src="../../assets/App installation-pana.png" width="100%" height="100%"> 
                </div>
          </div>
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
    </div>
</template>

<script>
import ServiceUser  from "../../Services/User.js"
import {AuthStore} from "../../store/index"
 export default{
    created(){
        this.name=this.store.User['name'];
        this.lastName=this.store.User['lastName']
        this.photo=this.store.User['Photo']
    },
    setup(){
        const store=AuthStore();
        return{store};
    },
    data(){
        return{
            name:"",
            lastName:"",
            photo:"",
            password:"",
            confirm:"",
            snackbar:false,
            text:""
        }
    },
   
    methods:{
        changePhoto(){
             this.photo=this.$refs.photo.files[0];
        },
        Setting(){
            if(this.password!=this.confirm){
                this.snackbar=true;
                this.text="password shoub be some confirmPassword";
            }
            ServiceUser.editUser({
                "nom":this.name,
                "lastname":this.lastName,
                "photo":this.photo,
                "password":this.password
            },this.store.User['id']).then((res)=>{
                this.snackbar=true;
                this.text="Changed With Success";
                this.store.SetUser(res.data.data);
            }).catch((error)=>{
                console.log(error);
            })
        }
    }
 }
</script>