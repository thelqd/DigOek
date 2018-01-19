<template>
  <div class="hello col-md-8">
    <div class="row">
      <div class="card">
        <div class="card-block">
          <h4 class="card-title">{{ msg }}</h4>
          <p class="card-text">Text</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Welcome',
  data () {
    return {
      msg: 'Welcome to Bad Hotel!'
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>

</style>
