<template>
  
  <section id="home" class="hero">
    
    <div class="hero__bg"></div>
    <div class="hero__smoke"></div>
    <!-- <div class="hero__dark"></div> -->
    

   <div class="hero__content"> <p class="hero__eyebrow"> {{ t.eyebrow }} </p>
     <img src="../assets/images/LOGO-backgroudoff.png" alt="MARCO Delicatess Selection logo" class="hero__logo" fetchpriority="high" decoding="async" />
      <h1 class="hero__title"> {{ t.title }} </h1> <p class="hero__text"> {{ t.description }} </p> 
       
    </div>
  </section>
</template>

<script setup>
import '../assets/styles/hero.css'
import { computed } from "vue";
import { currentLanguage } from "../data/languageStore";
import { translations } from "../data/translations";

const t = computed(() => {
  return translations[currentLanguage.value].hero;
});
</script>
