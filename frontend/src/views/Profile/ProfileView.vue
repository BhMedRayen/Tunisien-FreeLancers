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
                <div class="row text-center" style="display: flex;align-items: center !important;">
                    <div class="col-lg-4 p-2">
                      <v-avatar size="100px">
                           <v-img  :src="'http://localhost:8000'+User['Photo']"></v-img>
                     </v-avatar>
                     <p>{{ User['name'] }} {{ User['lastName'] }}</p>
                    </div>
                    <div class="col-lg-4">
                      <div v-if="setup.IsClient==true">
                        <p class="text-center">
                          Welcome Our Client
                        </p>
                      </div>
                      <div v-else>
                          <p class="font-weight-bold">Skills 
                            <v-btn text @click="openSnackBarAddSkills()">
                               <v-icon>mdi-plus</v-icon>
                            </v-btn>
                          </p>
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

    <v-dialog
      v-model="dialogDeleteUpdate"
      persistent
      width="500"
    >

      <v-card>
        <v-card-title class="text-h5 grey lighten-2">
          {{skillSelected['Name_Service']}}
        </v-card-title>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="grey"
            text
            @click="refresh()"
          >
            Close
          </v-btn>
          <v-btn
            color="red"
              text
            @click="DeleteSkill()"
          >
            Delete
          </v-btn>
          <v-btn
            color="yellow"
            text
            @click="openUpdateSkill()"
          >
            Update
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog
      v-model="dialogSkills"
      persistent
      width="500"
    >
    <v-card  width="500"  >
  <v-card 
    class="mx-auto mb-2 mt-2"
    max-width="400"
    outlined
  >
  
  <p class="text-center mt-2">{{!isUpdate ? 'Add' : 'Updated'}} Skill</p>
      <v-card-text>
         <v-text-field
                  name="Name_Service"
                  label="Name_Service"
                  v-model="SkillsForm.Name_Service"
                  type="text"
                   placeholder="Enter Name_Service"
          ></v-text-field>
          <v-text-field
                  name="YearsBusiness"
                  label="YearsBusiness"
                  v-model="SkillsForm.YearsBusiness"
                  type="text"
                   placeholder="Enter YearsBusiness"
          ></v-text-field>
          <v-text-field
                  name="TypeService"
                  label="TypeService"
                  v-model="SkillsForm.TypeService"
                  type="text"
                   placeholder="Enter TypeService"
          ></v-text-field>
          <v-text-field
                  name="PrincesRange"
                  label="PrincesRange"
                  v-model="SkillsForm.PrincesRange"
                  type="text"
                   placeholder="Enter PrincesRange"
          ></v-text-field>
      </v-card-text>
 </v-card>
    <v-card-actions>
       <v-btn :color="!isUpdate ? 'primary' : 'yellow'"   @click="!isUpdate ?   AjoterSkills() : UpdateSkill()">
           {{!isUpdate ? 'Ajouter' :'Update'}}
       </v-btn>
       <v-btn color="grey" style="color: white;"  @click="refresh()">
           Cancel
       </v-btn>
    </v-card-actions>
    </v-card>
  
    </v-dialog>
        <v-sheet
    class="mx-auto text-center"
    max-width="700"
  >

    <v-slide-group 
      multiple
      show-arrows
    >
      <v-slide-item 
          v-for="(skill) in setup.Skills" 
        :key="skill.id"
      >
        <v-btn
          class="mx-2"
          depressed
          rounded
          @click="ChoseSkill(skill)"
        >
          {{ skill['Name_Service'] }}
        </v-btn>
    
      </v-slide-item>

    </v-slide-group>
  </v-sheet>
                      </div>
                    </div>
                    <div class="col-lg-4">
                        <v-btn plain color="#E84C03" @click="ChangeSettiing()">
                          Edit Profil
                        </v-btn>
                    </div>
                </div>    
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
import skillService from "../../Services/Skills.js"
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
            snackbar:false,
            isUpdate:false,
            text:"",
            setting:false,
            dialog:false,
            Description:"",
            updateDescription:"",
            dialogUpdate:false,
            posts:[],
            idSelected:"",
            showAccueil:true,
            model: null,
            dialogSkills:false,
            SkillsForm:{
              Name_Service:"",
              YearsBusiness:"",
              TypeService:"",
              PrincesRange:""
            },
            Skills:[],
            skillSelected:[],
            dialogDeleteUpdate:false
        }
    },
    methods:{
      openUpdateSkill(){
        this.isUpdate=true;
        this.dialogSkills=true;
        this.SkillsForm.Name_Service=this.skillSelected['Name_Service'];
        this.SkillsForm.PrincesRange=this.skillSelected['PrincesRange'];
        this.SkillsForm.TypeService=this.skillSelected['TypeService'];
        this.SkillsForm.YearsBusiness=this.skillSelected['YearsBusiness'];
      },
      DeleteSkill(){
          skillService.deleteSkill(this.skillSelected.id).then((res)=>{
            skillService.getSkills(this.User['id']).then((res)=>{
               this.setup.SetSkill(res.data.data);
            });
            this.snackbar=true;
            this.text="Skkill Deleted";
            this.refresh();
          })
      },
      ChoseSkill(skill){
        this.dialogDeleteUpdate=true;
        this.skillSelected=skill;
      },
      refresh(){
        this.SkillsForm.Name_Service="";
        this.SkillsForm.YearsBusiness="";
        this.SkillsForm.PrincesRange="";
        this.SkillsForm.TypeService="";
        this.dialogSkills=false;
        this.skillSelected=[],
        this.dialogDeleteUpdate=false;
        this.isUpdate=false;
      },
      AjoterSkills(){
        skillService.AddSKill({
          name:this.SkillsForm.Name_Service,
          years:this.SkillsForm.YearsBusiness,
          type:this.SkillsForm.TypeService,
          price:this.SkillsForm.PrincesRange,
          userid:this.User['id']
        }).then((res)=>{
          this.snackbar=true;
          this.text="Skill Adedd";
          this.refresh();
          this.setup.SetSkill(res.data.data);
        })
      },
      UpdateSkill(){
        console.log(this.skillSelected['id']);
        skillService.updateSkill(
          this.skillSelected['id'],{
          name:this.SkillsForm.Name_Service,
          years:this.SkillsForm.YearsBusiness,
          type:this.SkillsForm.TypeService,
          price:this.SkillsForm.PrincesRange,
        }).then((res)=>{
          skillService.getSkills(this.User['id']).then((res)=>{
               this.setup.SetSkill(res.data.data);
            });
            this.snackbar=true;
            this.text="Skkill Updated";
            this.refresh();
        })
      },
      openSnackBarAddSkills(){
        this.dialogSkills=true;
      },
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