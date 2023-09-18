<template>
    <div id="tab1">
        <div class="navbar">
         <v-toolbar   class="toolbar">
            <a type="hidden" href=""></a>
                <!-- --------------------titre-------------------------- -->
                <v-toolbar-title class="mt-2 py-2">
                    <img src="../../assets/logo//TF.png" width="100px"  alt="" >
                </v-toolbar-title>
                <!-- --------------------titre/-------------------------- -->
                <v-spacer></v-spacer>
                <v-container>
                    <div class="btns float-end">
                        <v-btn outlined rounded color="#E84C03" class="me-5" >
                              <router-link to="login" style="color: #E84C03;text-decoration: none;" >SignIn</router-link>   
                        </v-btn>

                        <v-btn elevation="0" rounded color="#E84C03" class="me-5 p-y5" dark>
                             <router-link to="signup" style="color: white;text-decoration: none;">SignUp</router-link>   
                        </v-btn> 
                    </div>
                </v-container>
        </v-toolbar> 
    </div>
    </div>
</template>

<script>



export default {
    data(){
        return{
            links:[
            {title:'SIGN IN',route:'signin'},
            {title:'SIGN UP',route:'signup'}
        ]
        }
    },  
    methods:{
    },
    components: {
    },
}
</script>
<style scoped>
.toolbar{
    position: fixed;
    z-index: 999;
    width: 100%;
}
</style>