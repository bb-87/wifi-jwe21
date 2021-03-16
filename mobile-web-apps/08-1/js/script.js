// https://leafletjs.com/
const map = L.map('map');

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);


function onPositionSuccess(position) {
    console.log(position);
    // position.coords.longitude
    // position.coords.latitude

    const center = [position.coords.latitude, position.coords.longitude];

    map.setView(center, 13);
    L.marker(center).addTo(map);

    L.circle(center, {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: position.coords.accuracy
    }).addTo(map);
}

function onPositionError(error) {
    console.log(error);
}

function getPosition() {
    // https://developer.mozilla.org/en-US/docs/Web/API/Geolocation_API/Using_the_Geolocation_API
    navigator.geolocation.getCurrentPosition(onPositionSuccess, onPositionError, {
        enableHighAccuracy: true,
        timeout: 500
    });
}

const output = document.querySelector('#output');

// Prüfen, ob der Browser geolocation unterstützt
if (navigator.geolocation) {
    output.textContent += 'Der Browser unterstützt die Geolocation API! ';

    // Prüfen, ob wir auf die Postition zugreifen dürfen:
    // https://developer.mozilla.org/en-US/docs/Web/API/Permissions_API
    navigator.permissions.query({name: 'geolocation'})
        .then(function(result) {
            console.log(result);

            if (result.state === 'prompt') {
                output.textContent += 'Der User wird noch gefragt, ob auf die Position zugeriffen werden darf. ';
                getPosition();
            } else if (result.state === 'granted') {
                output.textContent += 'Der User hat der Seite erlaubt, auf die Position zuzugreifen. ';
                getPosition();
            } else if (result.state === 'denied') {
                output.textContent += 'Der User hat der Seite NICHT erlaubt, auf die Position zuzugreifen. '
            } else {
                console.log('Unbekannter state: ' + result.state);
            }
        });
} else {
    output.textContent += 'Der Browser unterstützt die Geolocation API nicht!';
}
