<template>
  <div class="hello col-md-8">
    <template v-if="modalHotel">
    <div class="modal" tabindex="-1" role="dialog" style="display:block">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Hotel Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <template v-if="modalHotel" >
              <div class="row">
                 {{modalHotel.name}}<br/>
                 {{modalHotel.description}}  <star-rating :read-only="rated || shared.user == null" :rating="modalHotel.rating" @rating-selected="putRating"></star-rating>
              </div>
              <template v-if="booked==null">
              <div class="row" v-for="room in modalHotel.rooms" :key="room.id">
	            <div class="col-md-3 mb-3">
                  <img class="rounded mx-auto d-block" :src="'/static/pics/room' + (Math.abs(hashCode(room.name))%7+1) + '.jpg'"  style="width: 100%">
                </div>
                <div class="col-md-3 mb-3">
                  {{ room.name }}
                </div>
                <div class="col-md-3 mb-3">
                  € {{ room.price }}
                </div>

                <div class="col-md-3 mb-3">
                  <button type="button" :disabled="shared.user == null" class="btn btn-primary" @click="book(room.name)">Book!</button>
                </div>
              </div>
            </template>
            <template v-if="booked">
              <div class="row">
	              <div class="col-md-8 mb-3">
                  Thanks for booking {{ booked }}
                </div>

              <div class="col-md-3 mb-3">
                  <img class="rounded mx-auto d-block" :src="'/static/pics/room' + (Math.abs(hashCode(booked))%7+1) + '.jpg'"  style="width: 100%">
                </div>
              </div>
            </template>

            </template>
          </div>
        </div>
      </div>
    </div>
    </template>
    <form>
      <div class="form-row">
          <div class="form-group col-md-6 mb-4">
            <input type="text" placeholder="Hotel" class="form-control" id="inputHotel" v-model="searchHotel">
          </div>
		  <div class="form-group col-md-4 mb-4">
            <input type="text" placeholder="City" class="form-control" id="inputCity" v-model="searchCity">
          </div>
          <div class="form-group col-md-2 mb-4">
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
      <div class="row" v-for="hotel in hotels" :key="hotel.id">
	    <div class="col-md-12 mb-4">
		  <div class="card">
		    <div class="cardblock">
		      <div class="row">
			    <div class="col-md-4">
			      <img class="img-fluid rounded mb-3 mb-md-0" :src="'/static/pics/hotel' + (Math.abs(hashCode(hotel.name))%6+1) + '.jpg'"  alt="">
			    </div>
			    <div class="col-md-5">
				  <h4 class="card-title" style="margin-top: 5px">{{ hotel.name }}</h4>
				  <p class="card-text text-left">{{ hotel.name }}  is the right choice for visitors who are searching for a combination of charm and design, and a convenient position from which to explore the city.</p>
				  <p class="card-text">Rating</p>
				</div>
			    <div class="col-md-3">
				  <h2 class="card-text">€ 9,99</h2>
				  <a class="btn btn-primary" style="color: #fff" @click="viewHotel(hotel)">View Rooms</a>
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
import StarRating from 'vue-star-rating'
export default {
  name: 'Hotels',
  components: {
    StarRating
  },
  data () {
    return {
      shared: data.shared,
      searchHotel: '',
      searchCity: '',
      hotels: null,
      modalHotel: null,
      rated: false,
      booked: null
    }
  },
  created () {
    this.fetchData()
  },
  watch: {
    searchHotel: function (val, oldVal) {
      console.log('new: %s, old: %s', val, oldVal)
      this.fetchData()
    }
  },
  methods: {
    hashCode (str) {
      return data.hashCode(str)
    },
    book (roomName) {
      data.bookHotel(this.modalHotel.id, roomName, (data, err) => {
        this.booked = roomName
        console.log(data)
      })
    },
    putRating (rating) {
      data.rateHotel(this.modalHotel.id, rating, (data, err) => {
        this.rated = true
      })
    },
    closeModal () {
      this.modalHotel = null
      this.booked = null
    },
    viewHotel (hotel) {
      this.modalHotel = []
      let self = this
      this.rated = false
      data.fetchHotel(hotel.id, (err, post) => {
        this.loading = false
        if (err) {
          this.error = err.toString()
          console.log(err)
        } else {
          self.modalHotel = post.data
          console.log(post)
        }
      })
    },
    fetchData () {
      console.log('fetch')
      this.error = this.post = null
      this.loading = true
      // replace `getPost` with your data fetching util / API wrapper
      data.fetchHotels(this.searchHotel, this.searchCity, (err, post) => {
        this.loading = false
        if (err) {
          this.error = err.toString()
          console.log(err)
        } else {
          this.hotels = post.data
          console.log(post)
        }
      })
    }
  }
}
</script>
<style>

</style>
