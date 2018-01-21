<template>
  <div class="hello col-md-8">
       <div class="card mb-4">
      <div class="card-header">
        <h4>Account</h4>
      </div>
	  <div class="card-body">
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
      <form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <input type="text" class="form-control" disabled v-model="shared.user.firstname" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <input type="text" class="form-control" disabled v-model="shared.user.lastname" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <input type="text" disabled class="form-control" v-model="shared.user.address.street" placeholder="1234 Main St">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <input type="text" class="form-control" v-model="shared.user.address.city">
    </div>
    <div class="form-group col-md-2">
      <input type="text" class="form-control" v-model="shared.user.address.zip_code">
    </div>
  </div>
  <button type="submit" class="btn btn-primary" @click="logout">Sign out</button>
</form>

    </template>
</div>  </div> </div>
</template>

<script>
import * as data from '../data.js'
import Cookie from 'js-cookie'
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
      let self = this
      data.login(this.username, this.password, (err, data) => {
        if (err) console.log(err)
        self.shared.user = data.data
        Cookie.set('auth', data.data)
      })
    },
    logout () {
      let self = this
      data.logout((err, data) => {
        if (err) console.log(err)
        self.shared.user = null
        Cookie.set('auth', null)
      })
    }
  }
}
</script>
<style>
</style>
