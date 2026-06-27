<template>
  <section id="recipes" class="ideas">
    <div class="ideas__intro">
      <div class="ideas__cta">
        <h3>{{ t.ctaTitle }}</h3>

        <p>
          {{ t.ctaText }}
        </p>
      </div>

      <span class="ideas__eyebrow">
        {{ t.eyebrow }}
      </span>

      <h2 class = "header">{{ t.title }}</h2>

      <p>
        {{ t.description }}
      </p>
    </div>

    <div
      v-for="category in categories"
      :key="category.title"
      class="ideas__category"
    >
      <div class="ideas__category-head">
        <div>
          <span>{{ category.label }}</span>
          <h3>{{ category.title }}</h3>
        </div>

        <p>{{ category.description }}</p>
      </div>

      <div class="ideas__slider">
        <article
          v-for="item in category.items"
          :key="item.title"
          class="ideas__card"
        >
          <img :src="item.image" :alt="`${item.title} sa MARCO proizvodima`" loading="lazy" decoding="async" />

          <div class="ideas__card-overlay">
            <span>{{ item.product }}</span>
            <h4>{{ item.title }}</h4>
            <p>{{ item.text }}</p>
          </div>
        </article>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed } from "vue";

import "../assets/styles/Ideas.css";

import { currentLanguage } from "../data/languageStore";
import { translations } from "../data/translations";

const t = computed(() => {
  return translations[currentLanguage.value].ideas;
});

const categories = computed(() => {
  return t.value.categories;
});
</script>