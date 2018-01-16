<template>
  <div class="hello">
    <form>
      <div class="form-row">
          <div class="form-group col-md-6">
            <input type="text" placeholder="Search..." class="form-control" id="inputSearch" v-model="searchString">
          </div>
          <div class="form-group col-md-4">
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
  </div>
</template>

<script>
export default {
  name: 'Hotels',
  data () {
    return {
      searchString: ''
    }
  },
  watch: {
    searchString: function (val, oldVal) {
      console.log('new: %s, old: %s', val, oldVal)
    }
  }
}
</script>
<style>
</style>
