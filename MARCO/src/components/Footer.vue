<template>
    <footer class="footer" id="footer">
        <div class="footer__container">
            <div class="footer__brand">
                <span class="footer__eyebrow">{{ t.eyebrow }}</span>

                <img :src="logo" alt="MARCO Delicatess Selection logo" class="footer__logo" loading="lazy" decoding="async" @click="scrollToTop" />

                <p>{{ t.description }}</p>

                <div class="footer__socials">
                    <a href="https://www.instagram.com/marco_delicatess_selection/" target="_blank"
                        rel="noopener noreferrer" aria-label="Instagram">
                        <Instagram :size="20" />
                    </a>

                    <a href="https://www.facebook.com/njeguskaprsuta.cetinje.7" target="_blank"
                        rel="noopener noreferrer" aria-label="Facebook">
                        <Facebook :size="20" />
                    </a>

                    <!-- <a href="#" aria-label="YouTube">
            <Youtube :size="20" />
          </a> -->
                </div>
            </div>

            <div class="footer__nav">
                <div class="footer__column">
                    <h4>{{ t.navigation }}</h4>
                    <a href="#products">{{ t.links.products }}</a>
                    <a href="#maturation">{{ t.links.production }}</a>
                    <a href="#recipes">{{ t.links.inspiration }}</a>
                    <a href="#partners">{{ t.links.partners }}</a>
                </div>

                <div class="footer__column">
                    <h4>{{ t.products }}</h4>
                    <a href="#products">{{ t.productLinks.prosciutto }}</a>
                    <a href="#products">{{ t.productLinks.pancetta }}</a>
                    <a href="#products">{{ t.productLinks.dryNeck }}</a>
                    <a href="#products">{{ t.productLinks.smokedLoin }}</a>
                </div>

                <div class="footer__column">
                    <h4>{{ t.contact }}</h4>

                    <a href="https://maps.app.goo.gl/EzSMrhyW2HZVoZ5i9" target="_blank" rel="noopener noreferrer"
                        class="location-link">
                        <MapPin :size="17" />
                        {{ t.location }}
                    </a>

                    <p>
                        <Truck :size="17" />
                        {{ t.delivery }}
                    </p>

                    <a href="mailto:info@meatgroup.me?subject=Upit sa MARCO Website&body=Poštovani," class="email-link">
                        <Mail :size="17" />
                        info@meatgroup.me
                    </a>

                    <a href="tel:+38269339289">
                        <Phone :size="17" />
                        +382 69 339 289
                    </a>
                </div>
            </div>
        </div>

        <div class="footer__bottom">
            <p>{{ t.rights }}</p>
        </div>
    </footer>
</template>

<script setup>
import "../assets/styles/footer.css";

import { computed } from "vue";
import { currentLanguage } from "../data/languageStore";
import { translations } from "../data/translations";

import {
    Instagram,
    Facebook,
    Youtube,
    MapPin,
    Mail,
    Phone,
    Truck,
} from "lucide-vue-next";

import logo from "../assets/images/LOGO-backgroudoff.png";

const t = computed(() => {
    const lang = translations[currentLanguage.value] ? currentLanguage.value : "cg";
    return translations[lang].footer;
});

const scrollToTop = () => {
    window.scrollTo({
        top: 0,
        behavior: "smooth",
    });
};
</script>