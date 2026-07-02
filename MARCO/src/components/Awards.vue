<script setup>
import { computed } from "vue";

import { Swiper, SwiperSlide } from "swiper/vue";
import { Autoplay, Pagination } from "swiper/modules";

import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";

import diploma1 from "../assets/images/awards/diploma1.png";
import diploma2 from "../assets/images/awards/Diploma2.png";
import diploma3 from "../assets/images/awards/Diploma3.png";
import diploma4 from "../assets/images/awards/Diploma4.png";
import medalImg from "../assets/images/awards/medalja1.png";

import { currentLanguage } from "../data/languageStore";
import { translations } from "../data/translations";

import {
  Trophy,
  ShieldCheck,
  MapPinned,
  // ChevronLeft,
  // ChevronRight
} from "lucide-vue-next";

const t = computed(() => translations[currentLanguage.value].awards);

const awards = [

{
    image: diploma4,
    alt: "Diploma Meat Group"
  },
  {
    image: diploma2,
    alt: "Diploma Meat Group"
  },
  {
    image: diploma3,
    alt: "Diploma Meat Group"
  }
  
];

const swiperModules = [Autoplay, Pagination];
</script>

<template>
  <section id="nagrade" class="awards">
    <div class="awards__container">
      <span class="awards__eyebrow">
        {{ t.eyebrow }}
      </span>

      <h2 class="header">
        {{ t.title }}
      </h2>

      <p class="awards__description">
        {{ t.description }}
      </p>

      <div class="awards__slider">
        <!-- <button class="awards__arrow awards__arrow--prev" aria-label="Previous award">
          <ChevronLeft />
        </button> -->

        <Swiper
          class="awards-swiper"
          :modules="swiperModules"
          :slides-per-view="1"
          :space-between="30"
          :loop="true"
          :speed="800"
          :autoplay="{
            delay: 6000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true
          }"
          
          :pagination="{
            clickable: true,
            el: '.awards__pagination'
          }"
        >
          <SwiperSlide
            v-for="award in awards"
            :key="award.alt"
          >
            <div class="award-card">
              <div class="award-card__image">
                <img
                  class="award-card__diploma"
                  :src="award.image"
                  :alt="award.alt"
                  loading="lazy"
                  decoding="async"
                />

                <div class="award-card__overlay">
                  <img
                    class="award-card__medal"
                    :src="medalImg"
                    :alt="t.medalAlt"
                    loading="lazy"
                    decoding="async"
                  />
                </div>
              </div>
            </div>
          </SwiperSlide>
        </Swiper>

        <!-- <button class="awards__arrow awards__arrow--next" aria-label="Next award">
          <ChevronRight />
        </button> -->

        <div class="awards__pagination"></div>
      </div>

      <div class="awards__features">
        <div class="feature">
          <div class="feature__icon">
            <Trophy />
          </div>

          <div>
            <h4>{{ t.firstTitle }}</h4>
            <p>{{ t.firstText }}</p>
          </div>
        </div>

        <div class="feature">
          <div class="feature__icon">
            <ShieldCheck />
          </div>

          <div>
            <h4>{{ t.secondTitle }}</h4>
            <p>{{ t.secondText }}</p>
          </div>
        </div>

        <div class="feature">
          <div class="feature__icon">
            <MapPinned />
          </div>

          <div>
            <h4>{{ t.thirdTitle }}</h4>
            <p>{{ t.thirdText }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style src="../assets/styles/awards.css" scoped></style>