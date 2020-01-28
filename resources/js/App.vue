<template>
  <div>
    <login-page v-if="!token" @token-received="setToken"></login-page>
    <todo-list v-else></todo-list>
  </div>
</template>
<script>
import LoginPage from "./components/Login.vue";
import TodoList from "./components/TodoList.vue";
export default {
  components: {
    "login-page": LoginPage,
    "todo-list": TodoList
  },
  data() {
    return {
      token: null
    };
  },
  methods: {
    setToken(token) {
      this.token = token;
      axios.defaults.headers.common["Authorization"] = "Bearer " + this.token;
    }
  }
};
</script>