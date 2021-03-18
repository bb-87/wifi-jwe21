/**
 * Eine Klasse, welche die Adresse als Textfeld auf der Seite darstellt.
 * 
 * Ausgehend von der Geolocation des Gerätes wird mittels OpenStreetMap API
 * die Adresse gefunden und in einem Textfeld angezeigt.
 * Die Positionierung passiert beim Erzeugen der Klasse und wenn der User
 * den "Find me" Button klickt.
 */
class Adresssuche {
    /**
     * Erzeugt ein neues Objekt der Klasse Adresssuche und versucht eine Adresse zu finden.
     */
    constructor(element) {
        this._element = element;

        // Unter this._element erzeugen wir einen input und einen button.
        // <input type="text" class="address">
        // <button class="btn-address">Find me</button>
        const input = document.createElement('input');
        const button = document.createElement('button');

        input.type = 'text';
        input.classList.add('input-address');

        button.textContent = 'Find me';
        button.classList.add('btn-address');

        this._element.appendChild(input);
        this._element.appendChild(button);

        const that = this;

        // Browserunterstützung?
        if (navigator.geolocation) {
            // User-Berechtigung?
            navigator.permissions.query({name: 'geolocation'})
                .then(function(result) {
                    if (result.state !== 'denied') {
                        that._getPosition();
                    }
                })

                // Statt "const that = this;" kann man auch Arrow functions verwenden
                // https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Functions/Arrow_functions
                // "Does not have its own bindings to `this`."
                // .then((result) => {
                //     if (result.state !== 'denied') {
                //         this._getPosition();
                //     }
                // })
        }

        button.addEventListener('click', function(event) {that._getPosition()});
        // button.addEventListener('click', this._getPosition());
    }

    _getPosition() {
        const that = this;

        navigator.geolocation.getCurrentPosition(
            function(position) {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;

                // div.classList.remove('warning');

                that._lat = lat;
                that._lon = lon;

                // https://nominatim.org/release-docs/develop/api/Reverse/
                fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=jsonv2`)
                    .then(function(response) {
                        if (response.ok) {
                            return response.json();
                        } else {
                            throw new Error('Error from Server');
                        }
                    })
                    .then(function(osmObject) {
                        console.log(osmObject);

                        that._address = osmObject.display_name;

                        that._element.querySelector('.input-address').value = that._address;
                    })
                    .catch(function(error) {
                        console.log('Error:', error);
                    });
            },
            function(error) {
                const div = document.querySelector('#adresssuche');
                div.textContent = `Error in getCurrentPosition: ${error}`;
                // div.classList.add('warning');
            },
            {
                enableHighAccuracy: true,
                timeout: 10 * 1000,
                maximumAge: 30 * 1000
            }
        )
    }

    /**
     * Gibt die Adresse des Users zurück
     * @returns {string} Die Adresse des Users
     */
    getAddress() {
        return this._address;
    }
}