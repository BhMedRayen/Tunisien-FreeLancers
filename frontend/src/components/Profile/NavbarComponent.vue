<template>
    <div>
        <v-app-bar
        color="#E84C03"
      dense
      dark
    >

      <v-toolbar-title @click="ChangeSettiing()">
        Tunisienn Freelancers
      </v-toolbar-title>

      <v-spacer></v-spacer>

      <v-col
          cols="12"
          sm="6"
          md="3"
          
        >
          <v-text-field
          class="pt-2"
            label="Search"
            append-icon="mdi-magnify"
            filled
          ></v-text-field>
        </v-col>

      <v-menu
        left
        bottom
      >
        <template v-slot:activator="{ on, attrs }">
          <v-btn
            icon
            v-bind="attrs"
            v-on="on"
          >
           Role <v-icon>mdi-arrow-down-thin</v-icon>
          </v-btn>
        </template>

        <v-list>
          <v-list-item
            v-for="(n,index) in Roles.length"
            :key="n"
            @click="() => {ChangerRoleSelected(Roles[index])}"
          >
            <v-list-item-title :color="Roles['index']==roleSlelected ? 'red' : '' ">{{ Roles[index] }}</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>

    <v-menu class="mx-4"
      :rounded="rounded"
       offset-y
      :nudge-width="100"
    >
      <template v-slot:activator="{ attrs, on }">
        <v-list-item-avatar  v-bind="attrs"
          v-on="on">
               <v-avatar size="43px">
                      <v-img  :src="'http://localhost:8000'+User['Photo']"></v-img>
                </v-avatar>
       </v-list-item-avatar>
       
      </template>

      <v-list>
        <v-list-item @click="logout()"
        >
        
            <v-list-item-content>
              <v-list-item-title>Logout</v-list-item-title>
            </v-list-item-content>
            <v-list-item-action>
              <v-btn text
              >
                <v-icon>mdi-logout</v-icon>
              </v-btn>
            </v-list-item-action>
        
        </v-list-item>
        <v-list-item @click="ChangeSettiing()"
        >
        
            <v-list-item-content >
              <v-list-item-title>Settings</v-list-item-title>
            </v-list-item-content>
            <v-list-item-action>
              <v-btn text
              >
                <v-icon>mdi-cog</v-icon>
              </v-btn>
            </v-list-item-action>
        
        </v-list-item>
      </v-list>
    </v-menu>
 
    </v-app-bar>
    </div>
</template>

<script>
import {AuthStore} from "../../store/index"
export default{

    mounted(){
        this.User=this.store.getUser;
    },

    setup(){
        const store=AuthStore();
        return{store}
    },  
    data(){
        return{
            User:[],
            Roles:["Client","Freelancer"],
            roleSlelected:"",
            search:"",
            errorSearch:""
        }
    },
    methods:{
      logout(){
        this.store.LogOut();
        this.$router.push({name:'login'});
      },
      ChangerRoleSelected(val){
        this.roleSlelected=val;
      },
      FetchData(){
        if(this.roleSlelected==""){
          this.errorSearch="Chose Role";
        }
      },
      ChangeSettiing(){
          this.$emit('ChangeSettiing');
      }
    }
}

</script>