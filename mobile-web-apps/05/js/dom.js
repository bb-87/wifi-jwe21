const main = document.querySelector('main');
const output = document.querySelector('#output');

let nextId = 0;
let counters = [];

function onCreateButtonClick(event) {
    counters.push(0);

    // Ein neues HTML Element ausserhalb des DOM Trees erzeugen:
    const myDiv = document.createElement('div');

    myDiv.textContent = '0';

    // // Mit dataset kann man den HTML Elementen beliebige Daten mitgeben
    // // In HTML Attributen: data-div-id="..." data-name="..."
    // myDiv.dataset.divId = nextId;
    // myDiv.dataset.name = 'Alex';

    myDiv.dataset.counterId = nextId;
    nextId++;

    // Ausgehend vom Parent (main) ein HTML Element (myDiv) als Kind einfügen
    main.appendChild(myDiv);

    // Geht auch:
    // myDiv.parentElement = main;
}

function onMainClick(event) {
    // output.textContent = `Es wurde auf ${event.target.dataset.divId} geklickt`;

    let counterId = parseInt(event.target.dataset.counterId);
    if (!isNaN(counterId) && counterId >= 0 && counterId < counters.length) {
        counters[counterId] += 1;
        event.target.textContent = counters[counterId];
    }
}

const createButton = document.querySelector('#create-button');
createButton.addEventListener('click', onCreateButtonClick);

main.addEventListener('click', onMainClick);