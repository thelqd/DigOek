<template>
  <div class="hello col-md-10" >
    <template v-if="modalHotel">
    <div class="modal" tabindex="-1" role="dialog" style="display:block">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Modal body text goes here.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" @click="closeModal">Close</button>
          </div>
        </div>
      </div>
    </div>
    </template>
    <form>
      <div class="form-row">
          <div class="form-group col-md-5 mb-5">
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
				  <a class="btn btn-primary" @click="viewHotel(hotel)">View Hotel</a>
			    </div>
			  </div>
			</div>
		  </div>
		</div>
      </div>
</template>
</div>
</template>

<script>
import * as data from '../data.js'
export default {
  name: 'Hotels',
  data () {
    return {
      searchHotel: '',
      searchCity: '',
      hotels: null,
      modalHotel: null
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
    closeModal () {
      this.modalHotel = null
    },
    viewHotel (hotel) {
      this.modalHotel = []

      data.fetchHotel(hotel.id, (err, post) => {
        this.loading = false
        if (err) {
          this.error = err.toString()
          console.log(err)
        } else {
          this.modalHotel = post
          console.log(post)
        }
      })
    },
    fetchData () {
      console.log('fetch')
      this.error = this.post = null
      this.loading = true
      // replace `getPost` with your data fetching util / API wrapper
      data.fetchHotels((err, post) => {
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
body {
  background: url(../pics/background.jpg);
  background-size: 100%;
  background-repeat: no-repeat;
  width: 100%;
}
</style>
