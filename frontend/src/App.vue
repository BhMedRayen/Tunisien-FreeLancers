<template>
  <v-app> 
     <Preloader></Preloader>
      <router-view v-slot="{ Component }">
         <transition name="fade"  mode="out-in">
                 <component :is="Component" />
          </transition>
       </router-view>
  </v-app>
</template>

<script>
import Preloader from "./components/Preloader.vue";
import AOS from "aos";
export default {
  name: 'App',
  mounted() {
      AOS.init();
     
    },
  data: () => ({
    //
  }),
  components:{
    Preloader
  }
};
</script>
