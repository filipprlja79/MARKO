<script setup>
import Header from './components/Header.vue'
import HeroSection from './components/HeroSection.vue'
import Contact from './components/Contact.vue'
import MaturationProcess from './components/MaturationProcess.vue'
import Products from "./components/Products.vue";
import Partners from './components/Partners.vue'
import IdeasSection from './components/Ideas.vue'
import Awards from './components/Awards.vue';
import FAQ from "./components/FAQ.vue";
import Footer from './components/Footer.vue';
import { useSeo } from './composables/useSeo';

useSeo();
</script>

<template>
  <Header />
  <HeroSection />
  <Products />
  <MaturationProcess />
  <Awards />
  <Partners />
  <IdeasSection />
  <FAQ />
  <Contact />
  <Footer/>
</template>