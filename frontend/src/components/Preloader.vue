<template>
    <div v-if="load" class="preloader" data-aos="zoom-in"  >
        <img src="../assets/logo/TF.png" >
    </div>
</template>

<script>
export default{
    mounted(){
        setTimeout(()=>this.load=false,3000);
    },
    data(){
        return{
            load:true
        }
    }
}
</script>

<style scoped>

img{
    width:600px ;
    height: 600px;
}
.preloader{
     background-color:  #fff;
     height: 100vh;
     position: fixed;
     z-index:99999999;
     top:0;
     left:0;
     width: 100vw;
     display: flex;
     min-height: 100vh;
     justify-content: center;
     align-items: center;
}

@media screen and (max-width: 700px) {
        img{
            width:200px ;
            height: 200px;
        }
}

</style>