<template>
   <NavbarComponent></NavbarComponent>
</template>

<script>

import {AuthStore} from "../../store/index"
import NavbarComponent from "../../components/Profile/NavbarComponent"
export default{

    mounted(){
        this.User=this.setup.getUser;
    },

    setup(){
        const setup=AuthStore();
        return{setup}
    },  
    data(){
        return{
            User:[]
        }
    },
    components:{
        NavbarComponent
    }
}

</script>