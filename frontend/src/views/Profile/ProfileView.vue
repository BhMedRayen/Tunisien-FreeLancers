<template>
            <div>
                <NavbarComponent @ChangeSettiing="ChangeSettiing" @editPageAccueil="editPageAccueil"></NavbarComponent>
                <div v-if="!setting && !showAccueil" >
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
        @click="ChangeSettiing()"
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
                            <v-dialog
      v-model="dialog"
      persistent
      width="500"
    >

      <v-card>
        <v-card-title class="text-h5 grey lighten-2 ">
          
            Add Post
        
        </v-card-title>

        <v-card-text>
            <v-textarea
                 name="input-7-1"
                 label="Description"
                 hint="Hint text"
                 v-model="Description"
        ></v-textarea>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="grey"
            text
            @click="dialog = false"
          >
            Close
          </v-btn>
          <v-btn
            color="green"
            text
            @click="addPOSt()"
          >
            Add
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>


    <v-dialog
      v-model="dialogUpdate"
      persistent
      width="500"
    >

      <v-card>
        <v-card-title class="text-h5 grey lighten-2">
          UpdatePost
        </v-card-title>

        <v-card-text>
            <v-textarea
                 name="input-7-1"
                 label="Description"
                 hint="Hint text"
                 v-model="updateDescription"
        ></v-textarea>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="grey"
            text
            @click="dialogUpdate = false"
          >
            Close
          </v-btn>
          <v-btn
            color="yellow"
            text
            @click="UpdatePost()"
          >
            Update
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
                            <v-card elevation="5">
                                     <div class="">
                                            <v-btn class="m-2" color="primary" @click="dialog=true">Add Post</v-btn>
                                    </div>
                                    <div v-if="posts==''" style="padding: 100px;">
                                        <h2 class="text-center " >No Posts</h2>
                                    </div>
                                <div v-else style="height: 300px; overflow-y: scroll;">

                                            <v-card v-for="item in posts"
    class="mx-auto mb-2 mt-2"
    max-width="344"
    outlined
  >
    <v-list-item three-line>
      <v-list-item-content>
        <div class="text-overline mb-4">
          {{item.user['name']}}
        </div>
        <v-list-item-subtitle class="text-h6 mb-1">{{item.description}}</v-list-item-subtitle>
      </v-list-item-content>

      <v-list-item-avatar
        tile
        size="80"
       
      >
      <img :src="'http://localhost:8000'+item.user['Photo']">
    </v-list-item-avatar>
    </v-list-item>

    <v-card-actions>
      <v-btn
        rounded
        color="primary"
      >
        Comments
      </v-btn>
      <v-btn
      style="color:white"
        rounded
        color="red"
         @click="deletepost(item.id)"
      >
        Delete
      </v-btn>
       <v-btn
       style="color:white"
        rounded
        color="yellow"
        @click="showDilaog(item.id,item.description)"
      >
        Update
      </v-btn>
      

    </v-card-actions>
  </v-card>
                                </div>
                            </v-card>
                      </div>
                </div>
            </div>  
               <div v-else-if="setting && !showAccueil">
                  <SettingComp></SettingComp>
               </div>
               <div v-else-if="!setting && showAccueil">
                  <Accuei></Accuei>
               </div>
              
            </div>
</template>

<script>
import postService from "../../Services/post.js"
import SettingComp from "../../components/Profile/Settings"
import {AuthStore} from "../../store/index"
import NavbarComponent from "../../components/Profile/NavbarComponent"
import Accuei from "../../views/Profile/AccueilView.vue"
export default{

    created(){
        this.User=this.setup.getUser;
        this.fetchData(this.User['id']);
    },

    setup(){
        const setup=AuthStore();
        return{setup}
    },  
    data(){
        return{
            User:[],
            setting:false,
            dialog:false,
            Description:"",
            updateDescription:"",
            dialogUpdate:false,
            posts:[],
            idSelected:"",
            showAccueil:true
        }
    },
    methods:{
      editPageAccueil(val){
        this.showAccueil=val;
        this.setting=false;
      },
        ChangeSettiing(){
           this.setting=!this.setting;
           this.showAccueil=false;
        },
        addPOSt(){
            if(this.Description==""){
                return;
            }
            postService.AddPostFn({
                id:this.setup.User['id'],
                description:this.Description
            }).then((res)=>{
                console.log(res.data);
                this.dialog=false;
                this.Description="";
                this.fetchData();
            }).catch((error)=>{
                console.log(error);
                this.Description="";
            })

        },
        fetchData(){
            postService.getPostsUser(this.User['id']).then((res)=>{
                this.posts=res.data.data;
            })
        },
        deletepost(id){
            postService.deletepost(id).then(
                (res)=>{
                    this.fetchData();
                }
            )
        },
        showDilaog(id,description){
            this.dialogUpdate=true;
            console.log(description);
            this.updateDescription=description;
            this.idSelected=id;
        },
        UpdatePost(){
            postService.updatepost({
                id:this.idSelected,
                description:this.updateDescription
            }).then((res)=>{
                this.dialogUpdate=false;
                this.fetchData();
            })
        }
    },
    components:{
        NavbarComponent,SettingComp,Accuei
    }
}

</script>