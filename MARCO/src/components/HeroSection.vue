<template>
  <section id="home" class="hero" aria-labelledby="hero-title">
    <div class="hero__bg" aria-hidden="true"></div>
    <div class="hero__smoke" aria-hidden="true"></div>

    <div class="hero__content">
      <p class="hero__eyebrow">{{ t.eyebrow }}</p>

      <img
        src="../assets/images/LOGO-backgroudoff.png"
        loading="lazy"
        :loading="lazy"
        :decoding="async"
        alt="MARCO Delicatess Selection - tradicionalni Njeguški pršut i premium delikatesi"
        class="hero__logo"
        fetchpriority="high"
      />

      <h1 id="hero-title" class="hero__title">{{ t.title }}</h1>

      <p class="hero__text">{{ t.description }}</p>
    </div>
  </section>
</template>

<script setup>
import "../assets/styles/hero.css";
import { computed } from "vue";
import { currentLanguage } from "../data/languageStore";
import { translations } from "../data/translations";

const t = computed(() => translations[currentLanguage.value].hero);
</script>