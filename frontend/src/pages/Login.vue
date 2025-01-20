<template>
  <div class="container">
    <h1>Login</h1>
    <form @submit.prevent="login">
      <div>
        <label>Email</label>
        <input v-model="email" type="email" placeholder="Email" required />
      </div>
      <div>
        <label>Password</label>
        <input v-model="password" type="password" placeholder="Password" required />
      </div>
      <button type="submit">Login</button>
    </form>
  </div>
</template>

<script>
import api from "../services/api";

export default {
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    async login() {
      try {
        const response = await api.post("/login", {
          email: this.email,
          password: this.password,
        });
        localStorage.setItem("token", response.data.token);
        this.$router.push("/dashboard");
      } catch (error) {
        alert("Login failed. Please check your credentials.");
      }
    },
  },
};
</script>
