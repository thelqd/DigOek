<template>
  <div id="app">
    <div class="row mb-4">
      <div class="col-md-2">
      </div>
      <div class="col-md-8">
        <div class="card">
          <nav class="navbar navbar-expand-sm bg-light">
            <ul class="navbar-nav">
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
        </div>
      </div>
      <div class="col-md-2">
      </div>
    </div>
    <div class="row">
      <div class="col-md-2">
      </div>
      <router-view/>
      <div class="col-md-2">
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>

<style>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 30px;
}

body {
  background: url(/static/pics/background.jpg) fixed;
  background-size: 100%;
  background-repeat: no-repeat;
  width: 100%;
}
</style>
