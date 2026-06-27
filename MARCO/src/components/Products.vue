<template>
  <section class="products" id="products">
    <div class="products__container">
      <div class="products__header">
        <span class="products__eyebrow">{{ t.eyebrow }}</span>

        <h2 class="section-header">{{ t.title }}</h2>

        <p style="color: #caa46d;">
          {{ t.description }}
        </p>
      </div>

      <div class="products__grid products__desktop">
        <article
          v-for="(product, index) in products"
          :key="product.name"
          class="product-card"
          :class="[
            product.className,
            { 'product-card--active': activeCard === index }
          ]"
          @click="toggleCard(index)"
        >
          <div class="product-card__image">
            <img :src="product.image" :alt="`${product.name} - MARCO Delicatess Selection`" loading="lazy" decoding="async" />
          </div>

          <div class="product-card__content">
            <span class="product-card__tag">{{ product.tag }}</span>
            <h3>{{ product.name }}</h3>
            <p>{{ product.description }}</p>
          </div>
        </article>
      </div>

      <Swiper
        class="products__mobile"
         :modules="[Autoplay]"
        :slides-per-view="1.12"
        :space-between="26"
        :centered-slides="true"
        :grab-cursor="true"
        :loop="true"
        :autoplay="{
    delay: 5000,
    disableOnInteraction: false
  }"
      >
        <SwiperSlide
          v-for="(product, index) in products"
          :key="product.name"
        >
          <article
            class="product-card"
            :class="[
              product.className,
              { 'product-card--active': activeCard === index }
            ]"
            @click="toggleCard(index)"
          >
            <div class="product-card__image">
              <img :src="product.image" :alt="`${product.name} - MARCO Delicatess Selection`" loading="lazy" decoding="async" />
            </div>

            <div class="product-card__content">
              <span class="product-card__tag">{{ product.tag }}</span>
              <h3>{{ product.name }}</h3>
              <p>{{ product.description }}</p>
            </div>
          </article>
        </SwiperSlide>
      </Swiper>
    </div>
  </section>
</template>

<script setup>
import { computed, ref } from "vue";
import { Autoplay } from "swiper/modules";
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";

import suviVrat from "../assets/images/suvi-vrat.jpg";
import pakovanjePrsute from "../assets/images/pakovanje-prsute.jpg";
import pakovanjePanceta from "../assets/images/pakovanje-panceta.jpg";
import amanetPakovanje from "../assets/images/amanet-pakovanje.jpg";
import suvaPecenica from "../assets/images/suva-pecenica.jpg";
import njeguskiPrsut from "../assets/images/njeguski-prsut.jpg";
import njeguskaPecenica from "../assets/images/njeguska-pecenica.jpg";
import slanina from "../assets/images/slanina.jpg";

import { currentLanguage } from "../data/languageStore";
import { translations } from "../data/translations";

const activeCard = ref(null);

const toggleCard = (index) => {
  activeCard.value = activeCard.value === index ? null : index;
};

const t = computed(() => {
  return translations[currentLanguage.value].products;
});

const products = computed(() => {
  return [
    {
      name: t.value.items.pakovanjePrsute.name,
      tag: t.value.items.pakovanjePrsute.tag,
      image: pakovanjePrsute,
      className: "product-card--package",
      description: t.value.items.pakovanjePrsute.description,
    },
    {
      name: t.value.items.njeguskiPrsut.name,
      tag: t.value.items.njeguskiPrsut.tag,
      image: njeguskiPrsut,
      className: "product-card--wide",
      description: t.value.items.njeguskiPrsut.description,
    },
    {
      name: t.value.items.amanet.name,
      tag: t.value.items.amanet.tag,
      image: amanetPakovanje,
      className: "product-card--package",
      description: t.value.items.amanet.description,
    },
    {
      name: t.value.items.pakovanjePanceta.name,
      tag: t.value.items.pakovanjePanceta.tag,
      image: pakovanjePanceta,
      className: "product-card--package",
      description: t.value.items.pakovanjePanceta.description,
    },
    {
      name: t.value.items.suviVrat.name,
      tag: t.value.items.suviVrat.tag,
      image: suviVrat,
      className: "product-card--tall",
      description: t.value.items.suviVrat.description,
    },
    {
      name: t.value.items.suvaPecenica.name,
      tag: t.value.items.suvaPecenica.tag,
      image: suvaPecenica,
      className: "product-card--wide",
      description: t.value.items.suvaPecenica.description,
    },
    {
      name: t.value.items.njeguskaPecenica.name,
      tag: t.value.items.njeguskaPecenica.tag,
      image: njeguskaPecenica,
      className: "product-card--tall",
      description: t.value.items.njeguskaPecenica.description,
    },
    {
      name: t.value.items.slanina.name,
      tag: t.value.items.slanina.tag,
      image: slanina,
      className: "product-card--wide",
      description: t.value.items.slanina.description,
    },
  ];
});
</script>

<style scoped>
@import "../assets/styles/products.css";
</style>