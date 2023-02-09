/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { i18n } from "./i18n.js";
import { createApp } from 'vue';
import router from './routes/routes';
import store from "./store";
import QrReader from 'vue3-qr-reader';
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";



const app = createApp({});
app.use(QrReader);
app.use(router);
app.use(store);
app.use(i18n);


import ScanQrComponent from './components/ScanQrComponent.vue';
app.component('example-component', ScanQrComponent);
import GlobalComponent from './components/GlobalComponent.vue';
app.component('global-component', GlobalComponent);
import AddParticipantComponent from './components/AddParticipantComponent.vue';
app.component('add-participant', AddParticipantComponent);
import App from './components/App.vue';
app.component('app', App);
import Footer from './components/Footer.vue';
app.component('footer-component', Footer);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.globEager('./**/*.vue')).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
