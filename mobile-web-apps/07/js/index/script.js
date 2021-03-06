function getFilms(event) {
    // fetch: https://ghibliapi.herokuapp.com/films 

    fetch('https://ghibliapi.herokuapp.com/films')
        .then(function(response) {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('API error');
            }
        })
        .then(function(films) {
            const ul = document.querySelector('#film-list');

            // Für jeden Film
            for (let film of films) {
                // erzeugen wir ein li
                const li = document.createElement('li');
                const title = film.title;
                const id = film.id;

                const a = document.createElement('a');
                
                // befüllen es mit Informationen zum Film
                a.textContent = title;
                a.href = `film.html?film_id=${id}`;

                // und fügen li an unsere ul hinzu
                li.appendChild(a);
                ul.appendChild(li);
            }
        });
}

document.querySelector('#get-film-btn').addEventListener('click', getFilms);