<template>
  <div class="hello col-md-10" >
    <form>
      <div class="form-row">
          <div class="form-group col-md-4">
            <input type="text" placeholder="Search..." class="form-control" id="inputSearch" v-model="searchString">
          </div>
          <div class="form-group col-md-3">
            <select id="inputStars" class="form-control">
              <option selected>Rating</option>
              <option>1+ Star</option>
              <option>2+ Star</option>
              <option>3+ Star</option>
              <option>4+ Star</option>
              <option>5 Star</option>
            </select>
          </div>
      </div>
    </form>
<template v-if="hotels">
      <div class="row" v-for="hotel in hotels.hotels" :key="hotel.id">
        <div class="col-md-4">
          <a href="#">
            <img class="img-fluid rounded mb-3 mb-md-0" src="http://placehold.it/700x300" alt="">
          </a>
        </div>
        <div class="col-md-6">
          <h3 >{{ hotel.name }}</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium veniam exercitationem expedita laborum at voluptate. Labore, voluptates totam at aut nemo deserunt rem magni pariatur quos perspiciatis atque eveniet unde.</p>
          <a class="btn btn-primary" href="#">View Hotel</a>
        </div>
      </div>
</template>
      <!-- /.row -->

  </div>
</template>

<script>
import { fetchHotels } from '../data.js'
export default {
  name: 'Hotels',
  data () {
    return {
      searchString: '',
      hotels: null
    }
  },
  created () {
    // fetch the data when the view is created and the data is
    // already being observed
    this.fetchData()
  },
  watch: {
    searchString: function (val, oldVal) {
      console.log('new: %s, old: %s', val, oldVal)
      this.fetchData()
    }
  },
  methods: {
    fetchData () {
      console.log('fetch')
      this.error = this.post = null
      this.loading = true
      // replace `getPost` with your data fetching util / API wrapper
      fetchHotels((err, post) => {
        this.loading = false
        if (err) {
          this.error = err.toString()
          console.log(err)
        } else {
          this.hotels = post
          console.log(post)
        }
      })
    }
  }
}
</script>
<style>

</style>
