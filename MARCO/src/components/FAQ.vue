<template>
  <section class="faq" id="faq">
    <div class="faq__container">
      <div class="faq__header">
        <span class="faq__eyebrow">{{ t.eyebrow }}</span>

         <h2 class = "header">{{ t.title }}</h2>

        <p>
          {{ t.description }}
        </p>
      </div>

      <div class="faq__list">
        <div
          v-for="(item, index) in faqs"
          :key="item.question"
          class="faq__item"
          :class="{ 'faq__item--open': openItems.includes(index) }"
        >
          <button
            class="faq__question"
            type="button"
            @click="toggle(index)"
          >
            <span>{{ item.question }}</span>

            <span class="faq__icon">
              <span></span>
              <span></span>
            </span>
          </button>

          <div
            class="faq__answer-wrap"
            :class="{ 'faq__answer-wrap--open': openItems.includes(index) }"
          >
            <div class="faq__answer">
              <p>{{ item.answer }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed } from "vue";
import "../assets/styles/FAQ.css";

import { currentLanguage } from "../data/languageStore";
import { translations } from "../data/translations";

const openItems = ref([]);

const t = computed(() => {
  return translations[currentLanguage.value].faq;
});

const faqs = computed(() => {
  return t.value.items;
});

const toggle = (index) => {
  if (openItems.value.includes(index)) {
    openItems.value = openItems.value.filter((item) => item !== index);
  } else {
    openItems.value.push(index);
  }
};
</script>