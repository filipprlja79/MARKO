<template>
  <section id="partners" class="partners">
    <div class="partners__container">
      <span class="partners__eyebrow">{{ t.eyebrow }}</span>

      <h2 class = "header">{{ t.title }}</h2>

      <p class="partners__lead">
        {{ t.description }}
      </p>

      <div class="partners__grid partners__desktop">
        <article
          v-for="partner in partners"
          :key="partner.name"
          class="partners__item"
        >
          <img :src="partner.logo" :alt="`${partner.name} partner MARCO proizvoda`" loading="lazy" decoding="async" />
          <h3>{{ partner.name }}</h3>
          <p>{{ partner.description }}</p>
        </article>
      </div>

     <Swiper
  class="partners__mobile partners__fade"
  :modules="[Autoplay, EffectFade]"
  effect="fade"
  :fade-effect="{ crossFade: true }"
  :slides-per-view="1"
  :loop="true"
  :speed="1000"
  :long-swipes="false"
:short-swipes="true"
:follow-finger="false"
:threshold="40"
  :allow-touch-move="true"
  :autoplay="{
    delay: 3500,
    disableOnInteraction: false
  }"
>
  <SwiperSlide
    v-for="partner in partners"
    :key="partner.name"
  >
    <article class="partners__item">
      <img :src="partner.logo" :alt="`${partner.name} partner MARCO proizvoda`" loading="lazy" decoding="async" />
      <h3>{{ partner.name }}</h3>
      <p>{{ partner.description }}</p>
    </article>
  </SwiperSlide>
</Swiper>

      <p class="partners__bottom">
        {{ t.bottom }}<br> <br>
        <a
    class="partners__location"
    href="https://maps.app.goo.gl/EzSMrhyW2HZVoZ5i9"
    target="_blank"
    rel="noopener noreferrer"
  >
  
   <span class="partners__pin"><div class="feature__icon">
  <MapPin />
</div></span> {{ t.location }}
    
  </a>
      </p>
      
    </div>
  </section>
</template>

<script setup>
import { computed } from "vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "../assets/styles/partners.css";
import { Autoplay, EffectFade } from "swiper/modules";
import "swiper/css";
import "swiper/css/effect-fade";
import { currentLanguage } from "../data/languageStore";
import { translations } from "../data/translations";
import { MapPin } from "lucide-vue-next";
import voliLogo from "../assets/images/partneri/Voli.png";
import domacaLogo from "../assets/images/partneri/Domaca-trgovina.png";
import jugopetrolLogo from "../assets/images/partneri/Eko.png";
import megaLogo from "../assets/images/partneri/Mega-market.png";
import aerodromiLogo from "../assets/images/partneri/Aerodromi-CG.png";

const t = computed(() => {
  return translations[currentLanguage.value].partners;
});

const partners = computed(() => {
  return [
    {
      name: t.value.items.voli.name,
      logo: voliLogo,
      description: t.value.items.voli.description,
    },
    {
      name: t.value.items.domaca.name,
      logo: domacaLogo,
      description: t.value.items.domaca.description,
    },
    {
      name: t.value.items.jugopetrol.name,
      logo: jugopetrolLogo,
      description: t.value.items.jugopetrol.description,
    },
    {
      name: t.value.items.mega.name,
      logo: megaLogo,
      description: t.value.items.mega.description,
    },
    {
      name: t.value.items.aerodromi.name,
      logo: aerodromiLogo,
      description: t.value.items.aerodromi.description,
    },
  ];
});
</script>