// const SERVERURL = 'https://do.faljse.info/dummy/'
const SERVERURL = 'https://do.faljse.info/backend/public/v1/public/'

export function fetchHotels (searchHotel, searchCity, cb) {
  fetch(SERVERURL + 'search?search=' + searchHotel + '&auth=9ecc8459ea5f39f9da55cb4d71a70b5d1e0f0b80').then(function (response) {
    return response.json()
  }).then(function (data) {
    cb(null, data.data)
  })
}

export function fetchHotel (id, cb) {
  fetch(SERVERURL + 'hotel.php').then(function (response) {
    return response.json()
  }).then(function (data) {
    cb(null, data)
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
