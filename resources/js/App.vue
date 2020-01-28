<template>
  <div>
    <login-page v-if="!token"></login-page>
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
  computed: {
    token() {
      return this.$store.state.token;
    }
  }
};
</script>