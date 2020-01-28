<template>
  <div id="login">
    <form @submit.prevent="login">
      E-Posta:
      <input type="email" v-model="login_email" />
      <br />Parola:
      <input type="password" v-model="login_password" />
      <br />
      <button type="submit">Giriş Yap</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      login_email: null,
      login_password: null
    };
  },
  methods: {
    login() {
      axios
        .post("http://oyk2020.kis/api/auth/login", {
          email: this.login_email,
          password: this.login_password
        })
        .then(response => {
          this.$store.commit("setToken", response.data.access_token);
        })
        .catch(response => console.error(response));
    }
  }
};
</script>