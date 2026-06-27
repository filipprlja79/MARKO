import { ref } from "vue";

export const currentLanguage = ref("cg");

export const setLanguage = (lang) => {
  currentLanguage.value = lang;
};