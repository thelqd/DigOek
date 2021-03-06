import axios from 'axios'

// const SERVERURL = 'https://do.faljse.info/dummy/'
const SERVERURL = 'https://do.faljse.info/backend/public/v1/public/'

export const shared = {
  user: null,
  authkey: null,
  apikey: '9ecc8459ea5f39f9da55cb4d71a70b5d1e0f0b80'
}

export function fetchHotels (searchHotel, searchCity, cb) {
  axios.get(SERVERURL + 'search', {
    params: {
      search: searchHotel,
      auth: shared.apikey
    }
  })
    .then(function (response) {
      console.log(response)
      cb(null, response.data)
    })
    .catch(function (error) {
      console.log(error)
      cb(error)
    })
}

export function bookHotel (id, roomName, cb) {
  axios.post(SERVERURL + 'book/' + id + '/' + encodeURIComponent(roomName), {
    auth: shared.apikey,
    usertoken: shared.user.usertoken
  }, {
    params: {
      auth: shared.apikey
    }
  })
    .then(function (response) {
      console.log(response)
      cb(null, response.data)
    })
    .catch(function (error) {
      cb(error)
      console.log(error)
    })
}

export function rateHotel (id, rating, cb) {
  axios.put(SERVERURL + 'rate/' + id, {
    stars: rating
  }, {
    params: {
      auth: shared.apikey
    }
  })
    .then(function (response) {
      console.log(response)
      cb(null, response.data)
    })
    .catch(function (error) {
      cb(error)
      console.log(error)
    })
}

export function fetchHotel (id, cb) {
  axios.get(SERVERURL + 'hotel/' + id, {
    params: {
      auth: shared.apikey
    }
  })
    .then(function (response) {
      console.log(response)
      cb(null, response.data)
    })
    .catch(function (error) {
      cb(error)
      console.log(error)
    })
}

export function logout (cb) {
  axios.put(SERVERURL + 'logout', {
    auth: shared.apikey,
    usertoken: shared.user.usertoken
  }, {
    params: {
      auth: shared.apikey
    }
  })
    .then(function (response) {
      console.log(response)
      cb(null)
    })
    .catch(function (error) {
      cb(error)
      console.log(error)
    })
}
export function login (username, password, cb) {
  axios.put(SERVERURL + 'login', {
    auth: shared.apikey,
    pid: 123,
    username,
    password
  }, {
    params: {
      auth: shared.apikey
    }

  })
    .then(function (response) {
      console.log(response)
      cb(null, response.data)
    })
    .catch(function (error) {
      cb(error)
      console.log(error)
    })
}

// from http://mediocredeveloper.com/wp/?p=55
export function hashCode (str) {
  var hash = 0
  if (str.length === 0) return hash
  for (let i = 0; i < str.length; i++) {
    let char = str.charCodeAt(i);		hash = ((hash << 5) - hash) + char;		hash = hash & hash // Convert to 32bit integer
  }
  return hash
}
