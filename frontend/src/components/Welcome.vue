<template>
  <div class="hello col-md-8">
    <div class="card mb-4">
      <div class="card-header">
        <h4>{{ msg }}</h4>
      </div>
	  <div class="card-body">
        <div class="row mb-4">
	      <div class="col-md-6">
            <h5 class="card-title" style="text-align: left">About us</h5>
		    <p class="card-text"  style="text-align: left">It all started with three students and a rather good idea.
Business Informatic Students realized how useful it would be to connect hotels and guests.
From their rooms in flatshares, they built a website called Bad Hotel.<br/>
The formula for success was pretty simple: working hard to get it right for the professor.<br/>
We move forward by taking lots of small steps and executing at incredible speeds.
Also we are never satisfied and keep proving ourselves every day.</p>
          </div>
	      <div class="col-md-6">
            <img class="rounded mx-auto d-block" :src="'/static/pics/welcome-image.jpg'"  style="width: 100%">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <img class="card-img-top" id="profilecards" :src="'/static/pics/avatar.png'" alt="Card image cap">
          <div class="card-body">
            <h4 class="card-title">Martin Kunz</h4>
            <p class="card-text">Business Informatics Student</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img class="card-img-top" id="profilecards" :src="'/static/pics/avatar.png'" alt="Card image cap">
          <div class="card-body">
            <h4 class="card-title">Daniel Schubert</h4>
            <p class="card-text">Business Informatics Student</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img class="card-img-top" id="profilecards" :src="'/static/pics/avatar.png'" alt="Card image cap">
          <div class="card-body">
            <h4 class="card-title">Barbara Dimmy</h4>
            <p class="card-text">Business Informatics Student</p>
          </div>
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
  #profilecards {
    height: 150px;
    width: 150px;
    margin: 0 auto;
    margin-top: 30px
  }
</style>
