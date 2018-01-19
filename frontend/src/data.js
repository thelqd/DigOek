const SERVERURL = 'https://do.faljse.info/dummy/'

export function fetchHotels (cb) {
  fetch(SERVERURL + 'hotels.php').then(function (response) {
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
