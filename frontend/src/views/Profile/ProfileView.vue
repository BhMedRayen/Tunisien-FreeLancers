<template>
    <div>
            {{user}}
    </div>
</template>

<script>
import {AuthStore} from "../../store/index"
export default{

    mounted(){
        this.User=this.setup.getUser();
    },

    setup(){
        const setup=AuthStore();
        return{setup}
    },  
    data(){
        return{
            User:[]
        }
    }
}

</script>