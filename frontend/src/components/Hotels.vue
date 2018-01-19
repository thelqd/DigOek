<template>
  <div class="hello col-md-10" >
    <form>
      <div class="form-row">
          <div class="form-group col-md-4 mb-5">
            <input type="text" placeholder="Hotel" class="form-control" id="inputHotel" v-model="searchHotel">
          </div>
		  <div class="form-group col-md-3 mb-5">
            <input type="text" placeholder="City" class="form-control" id="inputCity" v-model="searchCity">
          </div>
          <div class="form-group col-md-2 mb-5">
            <select id="inputStars" class="form-control">
              <option selected>Rating</option>
              <option>1+ Star</option>
              <option>2+ Star</option>
              <option>3+ Star</option>
              <option>4+ Star</option>
              <option>5 Star</option>
            </select>
          </div>
		  <div class="col-md-1 mb-5">
		    <button class="btn btn-primary" type="submit" style="width: 100%">Search</button>
		  </div>
      </div>
    </form>
<template v-if="hotels">
      <div class="row" v-for="hotel in hotels.hotels" :key="hotel.id">
	    <div class="col-md-10 mb-3">
		  <div class="card">
		    <div class="cardblock">
		      <div class="row">
			    <div class="col-md-4">
			      <img class="img-fluid rounded mb-3 mb-md-0" src="../pics/hotel2.jpg" alt="">
			    </div>
			    <div class="col-md-5">
				  <h4 class="card-title" style="margin-top: 5px">{{ hotel.name }}</h4>
				  <p class="card-text text-left">{{ hotel.name }} mit seiner angenehmen Atmosphäre lädt Sie herzlich ein zum Erholen auf der Geschäftsreise, zum Erkunden der Umgebung und zum effektiven Arbeiten.</p>
				  <p class="card-text">Rating</p>
				</div>      
			    <div class="col-md-3">
				  <h2 class="card-text">€29,-</h2>
				  <a class="btn btn-primary" href="#">View Hotel</a>
			    </div>
			  </div>
			</div>
		  </div>
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
body{
				background: url(../pics/background.jpg);
				background-size: 100%;
				background-repeat: no-repeat;
				width: 100%;
			}
</style>
