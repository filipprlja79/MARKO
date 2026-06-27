<template>

  <section class="maturation" id="maturation">
    <div class="maturation__container">
      <div class="maturation__header">
        <span class="maturation__eyebrow">{{ t.eyebrow }}</span>
        <h2 class="section-header">{{ t.title }}</h2>
        <p>
          {{ t.description }}
        </p>
      </div>

      <div class="maturation__row">
        <div class="maturation__image">
          <img src="../assets/images/susara2.jpg" alt="Prirodno dimljenje MARCO suhomesnatih proizvoda" loading="lazy" decoding="async" />
        </div>

        <div class="maturation__content">
          <span>{{ t.firstTag }}</span>
          <h3>{{ t.firstTitle }}</h3>
          <p>
            {{ t.firstText }}
          </p>
        </div>
      </div>

      <div class="maturation__row maturation__row--reverse">
        <div class="maturation__image">
          <img src="../assets/images/susara1.jpg" alt="Sušenje i sazrijevanje Njeguškog pršuta u sušari" loading="lazy" decoding="async" />
        </div>

        <div class="maturation__content">
          <span>{{ t.secondTag }}</span>
          <h3>{{ t.secondTitle }}</h3>
          <p>
            {{ t.secondText }}
          </p>
        </div>
      </div>

      <div class="maturation__row">
        <div class="maturation__image">
          <img src="../assets/images/susara3.jpg" alt="Sazrijevanje tradicionalnih MARCO suhomesnatih proizvoda" loading="lazy" decoding="async" />
        </div>

        <div class="maturation__content">
          <span>{{ t.thirdTag }}</span>
          <h3>{{ t.thirdTitle }}</h3>
          <p>
            {{ t.thirdText }}
          </p>
        </div>
      </div>
    </div>
  </section>
 
</template>
 <script setup>
import { computed } from "vue";
import { currentLanguage } from "../data/languageStore";
import { translations } from "../data/translations";

const t = computed(() => {
  return translations[currentLanguage.value].maturationSection;
});
import "../assets/styles/MaturationProcess.css";
</script>
