<template>
  <header class="site-header">
    <button
      class="header__toggle"
      :class="{ 'header__toggle--open': isOpen }"
      type="button"
      :aria-label="isOpen ? 'Zatvori meni' : 'Otvori meni'"
      aria-controls="main-navigation"
      @click="isOpen = !isOpen"
    >
      <span></span>
      <span></span>
      <span></span>
    </button>

    <nav id="main-navigation" class="nav" :class="{ 'nav--open': isOpen }">
      <a href="#home" @click="closeMenu">{{ t.home }}</a>
      <a href="#products" @click="closeMenu">{{ t.products }}</a>
      <a href="#maturation" @click="closeMenu">{{ t.maturation }}</a>
      <a href="#nagrade" @click="closeMenu">{{ t.awards }}</a>
      <a href="#partners" @click="closeMenu">{{ t.partners }}</a>
      <a href="#recipes" @click="closeMenu">{{ t.ideas }}</a>
      <a href="#faq" @click="closeMenu">{{ t.faq }}</a>
      <a href="#contact" @click="closeMenu">{{ t.contact }}</a>

      <div class="language-switcher">
        <button
          class="language-switcher__button"
          type="button"
          :aria-label="`Promijeni jezik: ${activeLanguage.label}`"
          @click="isLangOpen = !isLangOpen"
        >
          <img
            :src="activeLanguage.flag"
            :alt="activeLanguage.label"
          />
        </button>

        <Transition name="language-dropdown">
          <div
            v-if="isLangOpen"
            class="language-switcher__dropdown"
          >
            <button type="button" aria-label="Crnogorski jezik" @click="changeLanguage('cg')">
              <img :src="languages.cg.flag" alt="Crnogorski" />
              <span>CG</span>
            </button>

            <button type="button" aria-label="English language" @click="changeLanguage('en')">
              <img :src="languages.en.flag" alt="English" />
              <span>ENG</span>
            </button>
          </div>
        </Transition>
      </div>
    </nav>
  </header>
</template>

<script setup>
import { ref, computed } from "vue";
import "../assets/styles/header.css";

import { languages } from "../data/languages";
import { currentLanguage, setLanguage } from "../data/languageStore";
import { translations } from "../data/translations";

const isOpen = ref(false);
const isLangOpen = ref(false);

const t = computed(() => translations[currentLanguage.value].header);

const activeLanguage = computed(() => languages[currentLanguage.value]);

const closeMenu = () => {
  isOpen.value = false;
};

const changeLanguage = (lang) => {
  setLanguage(lang);
  isLangOpen.value = false;
  isOpen.value = false;
};
</script>