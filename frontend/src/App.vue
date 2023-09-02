<template>
  <v-app> 
      <router-view v-slot="{ Component }">
         <transition name="fade"  mode="out-in">
                 <component :is="Component" />
          </transition>
       </router-view>
  </v-app>
</template>

<script>
import AOS from "aos";
export default {
  name: 'App',
  mounted() {
      AOS.init();
     
    },
  data: () => ({
    //
  }),
};
</script>
