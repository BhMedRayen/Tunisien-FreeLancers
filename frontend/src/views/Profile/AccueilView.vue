<template>
    <div class=" p-3 mt-5 m-4 ">
         <div class="mt-5 py-5" fluid>
                <v-card elevation="7">
                    <div v-if="posts==''" style="padding: 100px;">
                                        <h2 class="text-center " >No Posts</h2>
                                    </div>
                                <div v-else style="height: 600px; overflow-y: scroll;">
                                 <v-card v-for="item in posts"
                                    class="mx-auto mb-2 mt-2"
                                          max-width="600"
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
      <v-btn v-if="User['id']==item.user_id"
        rounded 
        color="#E84C03"
        style="color: white;"
        @click="showDialog(item.id)"
      >
        Comments
      </v-btn>
      <v-btn style="color: #000;" v-if="User['id']!=item.user_id"
        rounded
        color="yellow"
        @click="EnableAjout(item.id)"
      >
        Ajouter
      </v-btn>
    </v-card-actions>
  </v-card>
      </div>
 </v-card>
   </div>

   <v-dialog
      v-model="dialogAjouter"
      persistent
      width="500"
    >
    <v-card  width="500"  >
      <v-card 
    class="mx-auto mb-2 mt-2"
    max-width="400"
    outlined
  >
      <v-card-text>
         <v-text-field
                name="Comment"
               label="Comment"
                v-model="Comment"
                type="text"
                 placeholder="Enter Comment"
          ></v-text-field>
      </v-card-text>
 </v-card>
    <v-card-actions>
       <v-btn  @click="refresh()">
         Close
       </v-btn>
       <v-btn color="primary"  @click="AjouterComment()">
         Ajouter
       </v-btn>
    </v-card-actions>
    </v-card>
  
    </v-dialog>


   <v-dialog
      v-model="dialogComments"
      :persistent="comments=='' ? false : true "
      width="500"
    >
    <v-card v-if="comments==''">
      <p class="text-center">No Comments</p>
    </v-card>
    <v-card  v-else width="500" style="height: 400px; overflow-y: scroll;" >
      <v-card v-for="item in comments" 
    class="mx-auto mb-2 mt-2"
    max-width="400"
    outlined
  >
    <v-list-item three-line>
      <v-list-item-content>
        <div class="text-overline mb-4">
          {{item.user['name']}}
        </div>
        <v-list-item-subtitle class="text-h6 mb-1">{{item.comment}}</v-list-item-subtitle>
      </v-list-item-content>

      <v-list-item-avatar
        tile
        size="80"
      >
      <img :src="'http://localhost:8000'+item.user['Photo']">
    </v-list-item-avatar>
    </v-list-item>
 </v-card>
    <v-card-actions>
       <v-btn  @click="refresh()">
         Close
       </v-btn>
    </v-card-actions>
    </v-card>
  
    </v-dialog>
</div>
</template>

<script>
import {AuthStore} from "../../store/index"
import postService from "../../Services/post.js"
export default{
    created(){
        this.fetchData();
        this.User=this.setup.getUser;
    },
    setup(){
        const setup=AuthStore();
        return{setup}
    },
    data(){
        return{
            dialogComments:false,
            PostId:"",
            User:[],
            comments:[],
            posts:[],
            dialogAjouter:false,
            Comment:""
        }
    },
    methods:{
      EnableAjout(id){
        this.PostId=id;
        this.dialogAjouter=true;
        this.Comment=""
      },
      AjouterComment(){
        postService.ajouterComment({
          id:this.User['id'],
          idpost:this.PostId,
          comment:this.Comment
        }).then((res)=>{
          this.refresh();
        })
      },
      showDialog(id){
        this.PostId=id;
        this.dialogComments=true;
        postService.getComments(id).then((res)=>{
          this.comments=res.data.data;
        })
      },
      refresh(){
        this.PostId="";
        this.dialogComments=false;
        this.dialogAjouter=false;
        this.comments=[];
        this.Comment="";
      },
        fetchData(){
            postService.getPosts().then((res)=>{
                this.posts=res.data.data;
            })
        },
    }
}
</script>