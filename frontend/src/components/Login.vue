<template>
  <div class="hello">
    <template v-if="shared.user === null">
      <form class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="userName" class="sr-only">Email address</label>
        <input type="text" v-model="username" id="userName" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" v-model="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit" @click="login">Sign in</button>
      </form>
    </template>
    <template v-if="shared.user">
      Logged in as {{shared.user}}
    </template>
  </div>
</template>

<script>
import * as data from '../data.js'
export default {
  name: 'Login',
  data () {
    return {
      shared: data.shared,
      username: null,
      password: null
    }
  },
  methods: {
    login () {
      data.login(this.username, this.password)
    }
  }
}
</script>
<style>
</style>
