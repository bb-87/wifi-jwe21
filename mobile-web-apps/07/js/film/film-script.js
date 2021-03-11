const params = new URLSearchParams(window.location.search);
const id = params.get('film_id');

if (id !== null) {
    // fetch auf API: https://ghibliapi.herokuapp.com/films/{id}
    fetch(`https://ghibliapi.herokuapp.com/films/${id}`)
        .then(function(response) {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('API error');
            }
        })
        .then(function(filmInfos) {
            const filmTitle = document.querySelector('#film-title');
            const title = filmInfos.title;
            filmTitle.textContent = title;

            const filmDescription = document.querySelector('#film-description');
            const description = filmInfos.description;
            filmDescription.textContent = description;
        });
        // .then(function(filmInfos) {
        //     const ul = document.querySelector('#film-info-list');

        //     for (let filmInfo in filmInfos) {
        //         const li = document.createElement('li');
        //         li.textContent = `${filmInfo}: ${filmInfos[filmInfo]}`;
        //         ul.appendChild(li);
        //     }
        // });
} else {
    document.querySelector('#film-title').textContent = 'Error 404: Seite nicht gefunden';
}

// HÜ: Hübsch machen