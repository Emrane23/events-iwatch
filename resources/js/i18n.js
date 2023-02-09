import { createI18n } from "vue-i18n";
// import messages from "@intlify/unplugin-vue-i18n/messages";
import { getCurrentLanguage } from "./utils";
import { mapActions } from './utils/map-state.js'
import store from "./store";
const locale = getCurrentLanguage();
const { setLang } = mapActions();
// List of all locales.
export const allLocales = ["fr", "ar"];

//datetime
const datetimeFormats = {
    'fr-FR': {
      short: {
        year: 'numeric', month: 'long', day: 'numeric'
      },
      long: {
        year: 'numeric', month: 'long', day: 'numeric',
        weekday: 'long', hour: 'numeric', minute: 'numeric',hour12: false
      }
    },
    'ar': {
      short: {
        year: 'numeric', month: 'short', day: 'numeric'
      },
      long: {
        year: 'numeric', month: 'short', day: 'numeric',
        weekday: 'short', hour: 'numeric', minute: 'numeric', hour12: false
      }
    }
  }
  

// Create Vue I18n instance.
export const i18n = createI18n({
    legacy: false,
    allowComposition: true,
    datetimeFormats,
    globalInjection: true,
    locale: locale || "fr",
    fallbackLocale: "fr",
    availableLocales: ["fr", "ar"],
    // messages: messages,
});

// Set new locale.
export async function setLocale(locale) {
    // Load locale if not available yet.
    if (!i18n.global.availableLocales.includes(locale)) {
        const messages = await loadLocale(locale);

        // fetch() error occurred.
        if (messages === undefined) {
            return;
        }

        // Add locale.
        i18n.global.setLocaleMessage(locale, messages);
    }

    // Set locale.
    i18n.global.locale.value = locale;

    setLang(locale)
}

// Fetch locale.
function loadLocale(locale) {
    return fetch(`./translations/locales/${locale}.json`)
        .then((response) => {
            if (response.ok) {
                return response.json();
            }
            throw new Error("Something went wrong!");
        })
        .catch((error) => {
            console.error(error);
        });
}
