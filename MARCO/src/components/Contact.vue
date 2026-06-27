<template>
  <section id="contact" class="contact">
    <div class="contact__container">

      <div class="contact__info">
        <span class="contact__subtitle">
          {{ t.subtitle }}
        </span>

        <h2 class="contact__title">
          {{ t.title }}
        </h2>

        <p class="contact__description">
          {{ t.description }}
        </p>

        <p class="contact__description">
          <strong>{{ t.emailLabel }}</strong>
          markovujovic@gmail.com
        </p>
      </div>

      <form class="contact__form">
        <label class="sr-only" for="contact-name">{{ t.namePlaceholder }}</label>
        <input
          id="contact-name"
          name="name"
          type="text"
          autocomplete="name"
          :placeholder="t.namePlaceholder"
          class="contact__input"
        >

        <label class="sr-only" for="contact-email">{{ t.emailPlaceholder }}</label>
        <input
          id="contact-email"
          name="email"
          type="email"
          autocomplete="email"
          :placeholder="t.emailPlaceholder"
          class="contact__input"
        >

        <label class="sr-only" for="contact-phone">{{ t.phonePlaceholder }}</label>
        <input
          id="contact-phone"
          name="phone"
          type="tel"
          autocomplete="tel"
          :placeholder="t.phonePlaceholder"
          class="contact__input"
        >

        <label class="sr-only" for="contact-message">{{ t.messagePlaceholder }}</label>
        <textarea
          id="contact-message"
          name="message"
          rows="6"
          :placeholder="t.messagePlaceholder"
          class="contact__textarea"
        ></textarea>

        <button
          type="submit"
          class="contact__button"
        >
          {{ t.button }}
        </button>
      </form>

    </div>
  </section>
</template>

<script setup>
import { computed } from "vue";
import "../assets/styles/contact.css";

import { currentLanguage } from "../data/languageStore";
import { translations } from "../data/translations";

const t = computed(() => {
  return translations[currentLanguage.value].contact;
});
</script>