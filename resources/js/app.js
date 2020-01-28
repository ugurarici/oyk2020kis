require("./bootstrap");
window.Vue = require("vue");

import store from './store';

import App from "./App.vue";

const app = new Vue({
    el: "#app",
    render: h => h(App),
    store
});
