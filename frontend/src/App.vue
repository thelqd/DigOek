<template>
  <div id="app">
    <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <router-link :exact=true active-class="active" class="nav-link" to="/">Welcome</router-link>
            </li>
            <li class="nav-item">
              <router-link active-class="active" class="nav-link" to="Login">Login</router-link>
            </li>
            <li class="nav-item">
              <router-link active-class="active" class="nav-link" to="Hotels">Hotels</router-link>
            </li>
            <li class="nav-item">
              <router-link active-class="active" class="nav-link" to="Logout">Logout</router-link>
            </li>
          </ul>
        </nav>
    <router-view/>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
