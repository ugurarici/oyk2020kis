require("./bootstrap");
window.Vue = require("vue");

import Vuex from "vuex";
Vue.use(Vuex);
import createPersistedState from "vuex-persistedstate";
const store = new Vuex.Store({
    state: {
        token: null
    },
    mutations: {
        setToken(state, token) {
            state.token = token;
        }
    },
    plugins: [
        createPersistedState({
            paths: ["token"]
        })
    ]
});

axios.interceptors.request.use(config => {
    if (store.state.token) {
        config.headers["Authorization"] = "Bearer " + store.state.token;
    }
    return config;
});

import App from "./App.vue";

const app = new Vue({
    el: "#app",
    render: h => h(App),
    store
});
