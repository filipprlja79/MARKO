import { watchEffect } from "vue";
import { currentLanguage } from "../data/languageStore";

const seo = {
  cg: {
    lang: "sr-ME",
    title: "MARCO Delicatess Selection | Njeguški pršut i delikatesi iz Crne Gore",
    description:
      "MARCO Delicatess Selection proizvodi tradicionalni Njeguški pršut, pancetu, suvi vrat, pečenicu i premium mesne delikatese sa Cetinja.",
    ogLocale: "sr_ME",
  },
  en: {
    lang: "en",
    title: "MARCO Delicatess Selection | Montenegrin prosciutto and premium delicacies",
    description:
      "MARCO Delicatess Selection produces traditional Montenegrin prosciutto, pancetta, dry neck, smoked loin and premium delicacies from Cetinje.",
    ogLocale: "en_US",
  },
};

const setMeta = (selector, attribute, value) => {
  const element = document.head.querySelector(selector);

  if (element) {
    element.setAttribute(attribute, value);
  }
};

export const useSeo = () => {
  watchEffect(() => {
    const data = seo[currentLanguage.value] || seo.cg;

    document.documentElement.lang = data.lang;
    document.title = data.title;

    setMeta('meta[name="description"]', "content", data.description);
    setMeta('meta[property="og:title"]', "content", data.title);
    setMeta('meta[property="og:description"]', "content", data.description);
    setMeta('meta[property="og:locale"]', "content", data.ogLocale);
    setMeta('meta[name="twitter:title"]', "content", data.title);
    setMeta('meta[name="twitter:description"]', "content", data.description);
  });
};
