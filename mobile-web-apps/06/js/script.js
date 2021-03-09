fetch('user.json')
    .then(function(response) {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error(`Fehler in Antwort vom Server (Statuscode: ${response.status} ${response.statusText})`);
        }
    })
    .then(function(users) {
        if (users.length === 0) {
            throw new Error('Es sind keine User vorhanden');
        }

        const ul = document.querySelector('#users-list');

        for (let user of users) {
            const id = user.id;
            const name = user.name;

            const li = document.createElement('li');
            li.textContent = name;
            li.dataset.userId = id;

            ul.appendChild(li);
        }
    })
    // Fehler, die in einer der Funktionen mit .then passieren (throw new Error) 
    // landen in der catch-Funktion
    .catch(function(error) {
        document.querySelector('#info').textContent = error.message;
    });


// Bei einem Klick auf eines der User li soll mit einem neuen fetch die 
// Detailinformation zu dem User geholt werden.
// 1 -> 'user/1.json'
// Detailinformationen im div#user-detail

function onUserClick(event) {
    const userID = parseInt(event.target.dataset.userId);
    console.log(userID);

    fetch(`user/${userID}.json`)
        .then(function(response) {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error(`Fehler in Antwort vom Server (Statuscode: ${response.status} ${response.statusText})`);
            }
        })
        .then(function(userDetails) {
            const age = userDetails.age;
            const hairColor = userDetails.hairColor;

            console.log(age);
            console.log(hairColor);

            const div = document.querySelector('#user-detail');
            div.textContent = `Alter: ${age}, Haarfarbe: ${hairColor}`;
        })
        .catch(function(error) {
            document.querySelector('#info').textContent = error.message;
        });
}

const ul = document.querySelector('#users-list');
ul.addEventListener('click', onUserClick);