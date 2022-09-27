<template>
  <div>

    <div class="cont-top shadow bg-white d-flex justify-content-end p-2">
      <button @click="goRegister" v-if="!register" class="btn btn-primary">Criar conta</button>
      <button @click="goLogin" v-if="!login" class="btn btn-primary">Login</button>
    </div>

    <AuthLayout v-slot:body>
      <div v-if="!register" class="animate__animated animate__fadeInLeft">
        <Login />
      </div>
      <div v-if="!login" class="animate__animated animate__fadeInRight">
        <Register />
      </div>
    </AuthLayout>

  </div>
</template>

<style>
.cont-top {
  z-index: 999 !important;
}
</style>

<script>
import Login from '../components/pages/Login.vue'
import Register from '../components/pages/Register.vue';
import 'animate.css';
import AuthLayout from '../components/layouts/AuthLayout.vue';

export default {
  layout: 'auth',
  components: {
    Login,
    Register,
    AuthLayout
  },
  data() {
    return {
      login: true,
      register: false
    }
  },
  methods: {
    goLogin: function () {
      this.register = false;
      this.login = true;
    },
    goRegister: function () {
      this.login = false;
      this.register = true;
    }
  }
}
</script>