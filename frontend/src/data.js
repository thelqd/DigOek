const SERVERURL = 'https://do.faljse.info/dummy/'

export function fetchHotels (cb) {
  fetch(SERVERURL + 'hotels.php').then(function (response) {
    return response.json()
  }).then(function (data) {
    cb(null, data.data)
  })
}