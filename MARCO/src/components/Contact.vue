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
          info@meatgroup.me
        </p>
      </div>

      <form class="contact__form" @submit.prevent="sendMessage">
        <label class="sr-only" for="contact-name">{{ t.namePlaceholder }}</label>
        <input id="contact-name" v-model="form.name" name="name" type="text" autocomplete="name"
          :placeholder="t.namePlaceholder" class="contact__input">

        <label class="sr-only" for="contact-email">{{ t.emailPlaceholder }}</label>
        <input id="contact-email" v-model="form.email" name="email" type="email" autocomplete="email"
          :placeholder="t.emailPlaceholder" class="contact__input">

        <label class="sr-only" for="contact-phone">{{ t.phonePlaceholder }}</label>
        <input id="contact-phone" v-model="form.phone" name="phone" type="tel" autocomplete="tel"
          :placeholder="t.phonePlaceholder" class="contact__input">

        <label class="sr-only" for="contact-message">{{ t.messagePlaceholder }}</label>
        <textarea id="contact-message" v-model="form.message" name="message" rows="6"
          :placeholder="t.messagePlaceholder" class="contact__textarea"></textarea>

        <ContactButton :loading="loading" :success="success" />

        <p v-if="!success && responseMessage" class="contact__response contact__response--error">
          {{ responseMessage }}
        </p>
      </form>
    </div>
  </section>
</template>

<script setup>
import { computed, reactive, ref } from "vue";
import "../assets/styles/contact.css";

import ContactButton from "./button.vue";
import { currentLanguage } from "../data/languageStore";
import { translations } from "../data/translations";

const t = computed(() => {
  return translations[currentLanguage.value].contact;
});

const form = reactive({
  name: "",
  email: "",
  phone: "",
  message: ""
});

const loading = ref(false);
const responseMessage = ref("");
const success = ref(false);

const sendMessage = async () => {
  responseMessage.value = "";
  success.value = false;

  if (!form.name || !form.email || !form.message) {
    responseMessage.value =
      currentLanguage.value === "cg"
        ? "Molimo popunite obavezna polja."
        : "Please fill in the required fields.";
    return;
  }

  loading.value = true;

  try {
    const response = await fetch("/backend/contact.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        name: form.name,
        email: form.email,
        phone: form.phone,
        message: form.message
      })
    });

    const result = await response.json();

    responseMessage.value = result.message;
    success.value = result.success;

    if (result.success) {
      form.name = "";
      form.email = "";
      form.phone = "";
      form.message = "";
    }
  } catch (error) {
    responseMessage.value =
      currentLanguage.value === "cg"
        ? "Došlo je do greške. Pokušajte ponovo."
        : "An error occurred. Please try again.";

    success.value = false;
  } finally {
    loading.value = false;
  }
};
</script>