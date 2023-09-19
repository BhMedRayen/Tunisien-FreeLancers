<template>
  <div>
    <navbarComp></navbarComp>
      <v-container  class=" fluid mt-5 py-5 sec1">
          <!-- ------------------section 1 ------------------------------------>
          <div class="sec1">
              <v-container class="py-4 ">
                  <v-layout flex wrap class="py-4" >
                      <v-flex xl6 lg6 md6 sm12 xs12 data-aos="fade-right">
                          <div class="title">
                              <span class="title-word title-word-1">Tunisien</span>
                              <span class="title-word title-word-2">Freelancer</span>
                          </div>
                          <p class="p1">{{ p1 }}</p>
                      </v-flex>
                      <v-flex xl6 lg6 md6 sm12 xs12 data-aos="fade-left">
                        <img id="im2" src="../assets/logo/img1.jpg" width="500px" class="px-5">
                      </v-flex>
                  </v-layout>
              </v-container>
          </div>
             
          <!-- ------------------ /section 1 ------------------------------------>
      </v-container>

      <!-- ------------------section 2 ------------------------------------>
      <div class="sec2">
          <v-container  class=" fluid mt-5 py-5">
                  <v-container class="py-4">
                      <v-layout flex wrap class="py-4" >
                          <v-flex xl6 lg6 md6 sm12 xs12 data-aos="fade-right">
                            <img id="im2" src="../assets/pexels-lisa-fotios-16129728.jpg" width="500px" class="px-5">
                          </v-flex>
                          <v-flex xl6 lg6 md6 sm12 xs12 data-aos="fade-left">
                              <p class="p1">{{ p2}}</p>
                          </v-flex>
                          
                      </v-layout>
                  </v-container>
          </v-container>
      </div>
      <div class="line1">
      </div>
      <!-- ------------------ /section 2 ------------------------------------>


      <!-- ------------------section 3 ------------------------------------>
      <div class="subject">
          <h3 class="">OUR SERVICES</h3>
      </div>
      
      <div class="sec3">
          
          <v-container fluid>
                  
                  <v-layout flex wrap>
                      <v-flex xl3 lg3 md6 sm6 xs12 v-for="card in cards" :key="card.title" class="px-5 py-5" data-aos="fade-down">
                          <div class="card">
                              <v-avatar size="100">
                                 <v-icon color="black" size="40">mdi-{{ card.icon }}</v-icon>
                              </v-avatar>
                              <h2 class="align-center" id="h2">{{ card.title }}</h2>
                              <p id="p" class="">{{ card.p }}</p>
                          </div>
                      </v-flex>
                  </v-layout>
             
          </v-container>
      </div>
      
      <!-- ------------------ /section 3 ------------------------------------>


      <!-- ------------------ equipe ------------------------------------>
      <div class="subject">
          <h3 class="">Owner</h3>
      </div>
      <div class="equipe ">
          <v-container fluid>
              <div class="card2 pa-4 text-center rounded-0">
                <v-card
    class="mx-auto"
    max-width="344"
  >
    <v-img
      src="../assets/rayen (2).jpg"
      height="200px"
    ></v-img>

    <v-card-title>
     Rayen Ben Hassine
    </v-card-title>

    <v-card-subtitle>
       DSI32 Iset Bizerte
    </v-card-subtitle>

    <v-card-actions class="text-center mx-5">
      <div class="row mx-5">
         <div class="col-lg-3">
            <v-icon>mdi-facebook</v-icon>
         </div>
         <div class="col-lg-3">
            <v-icon>mdi-twitter</v-icon>
         </div>
         <div class="col-lg-3">
            <v-icon>mdi-instagram</v-icon>
         </div>
         <div class="col-lg-2">
            <v-icon>mdi-github</v-icon>
         </div>
      </div>  
      <v-spacer></v-spacer>

    </v-card-actions>

    
  </v-card>
              </div>
          </v-container>
      </div>
      <div style="bottom: 0;background-color: #000;color: white;text-align: center;">
          CopyRight 2022-2023
      </div>

      <!-- ------------------ /equipe ------------------------------------>
  </div>
  
</template>

<script>
import preloader from"../components/Preloader.vue"
 import  navbarComp  from "@/components/Home/navbar.vue";
export default {
 
  props:{
  },
  created(){
  },
  data: () => ({
      p1:'A specialized website tailored for Tunisian freelancers addresses a unique market need, connecting Tunisia growing pool of skilled professionals with clients worldwide. It offers a platform where freelancers can effectively display their talents, covering various fields like web development, graphic design, and content writing. This localized approach allows clients to access specialized skills with cultural insights and language proficiency.',
      p2:'The website empowers freelancers with tools to create comprehensive profiles, showcase portfolios, and promote their services, facilitating secure payment processing and seamless communication with clients. Additionally, it may provide valuable resources such as job listings, tutorials, and a supportive community.In essence, this dedicated platform benefits both local talent and global businesses by enhancing access to Tunisian freelancers expertise, thereby fostering economic growth and collaboration within Tunisias freelance community.',
      cards:[
          {title:'POST',p:'  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis, maxime!',icon:"post"},
          {title:'COMMENT',p:'  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis, maxime!',icon:"comment"},
          {title:'NOTIFICATION',p:'  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis, maxime!',icon:"bell-badge"},
          {title:'EDIT PROFIL',p:'  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis, maxime!.',icon:"human-edit"},
          
      ],

      equipes:[
          {name:'Rayen',image:require('../assets/logo.png')},
      ]
  }),
  components: {
    navbarComp,preloader
  },
}
</script>
<style scoped>
.p1{
  font-family: Verdana, Geneva, sans-serif;
font-size: 25px;
line-height: 40px;
color: #000000;
font-weight: 400;
text-decoration: none solid rgb(68, 68, 68);
font-style: normal;
font-variant: small-caps;

}
.p2{
  font-family: Verdana, Geneva, sans-serif;
  font-size: 15px;
  text-align: justify;
  color: #000000;
  font-weight: 400;
  text-decoration: none solid rgb(68, 68, 68);
  font-style: normal;
  font-variant: small-caps;
}

.title{
  margin-bottom: 25px;;
}
.title-word {
animation: color-animation 4s linear infinite;
font-size: 32px;
}

.title-word-1 {
--color-1: #f66641;
--color-2: #525fe1;
--color-3: #ff60aa;
}

.title-word-2 {
--color-1: #ffcf59;
--color-2: #5094df;
--color-3: #a6cd49;
}

.title-word-3 {
--color-1: #ACCFCB;
--color-2: #E4A9A8;
--color-3: #ACCFCB;
}

@keyframes color-animation {
0%    {color: var(--color-1)}
32%   {color: var(--color-1)}
33%   {color: var(--color-2)}
65%   {color: var(--color-2)}
66%   {color: var(--color-3)}
99%   {color: var(--color-3)}
100%  {color: var(--color-1)}
}
#im1{
  clip-path: polygon(0 5%, 100% 8%, 100% 94%, 0 96%);
}

.line1{
  background-color: #E84C03;
  height: 40px;
  clip-path: polygon(0 41%, 98% 69%, 100% 75%, 0 71%);
  width: 100%;
}
#im2{
  clip-path: polygon(0 7%, 100% 0, 100% 100%, 0 94%);
}

#h2{
  font-family: "Times New Roman", Times, serif;
  font-size: 20px;
  margin-top: 50px;
  letter-spacing: 5.4px;
  word-spacing: -5px;
  font-weight: 700;
  text-decoration: none;
  font-style: normal;
  font-variant: small-caps;
  text-transform: none;
  text-align: center;
  }
#p{
  font-size: 10px;
  margin-top: 20px;
  letter-spacing:2px;
  text-decoration: none;
  font-style: normal;
  text-transform: none;
  text-align:justify;
}
.sec2,.sec3{
  margin-top: 100px;
  margin-bottom: 200px;
}
.sec1{
  margin-top: 100px;
}
.equipe{
  margin-bottom: 100px;
}
.card{
  border:2px solid#E84C03;
  padding: 20px;
  height: 45vh;
  background-color: white;
  color: #444;
  display:flex;
  flex-direction: column;
  align-items: center;
}

.card:hover{
  background-color: #E84C03;
  color: white;
  
}
.subject{
  text-align: center;
  margin-top: 100px;
  left:50%;
  
}
.subject>h3{
  font-family: 'DM Sans', sans-serif;
  color: #E84C03;
  font-size: 30px;
  display: inline-block;
}
.card-body{
  border-radius: 5px;
  -webkit-box-shadow: -6px 5px 20px -10px #103a64; 
          box-shadow: -6px 5px 20px -10px #103a64;
}
</style>