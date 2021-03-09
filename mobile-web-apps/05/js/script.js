const main = document.querySelector('main');
const output = document.querySelector('#output');

let nextId = 0;
let animals = [];

function getRandomDogName() {
    const dogNames = ["King", "Peach", "Sparky", "Rex", "Baby", "Rover", "Misty"];
    return dogNames[Math.floor(Math.random() * dogNames.length)];
}

function getRandomCowName() {
    const cowNames = ['Ophelia', 'Zenzi', 'Resi'];
    return cowNames[Math.floor(Math.random() * cowNames.length)];
}

function onCreateButtonClick(event) {
    // HÜ: Ein zufälliges Tier soll erzeugt werden (nicht nur Hund!)
    // if (Math.random() > 0.5) ... else ...
    // HÜ: Je nach Tierart unterschiedliche Klassen setzen und mit CSS stylen
    const element = document.createElement('div');
    let animal;
    const id = nextId;
    nextId++;

    if (Math.random() < 0.5) {
        const name = getRandomDogName();
        animal = new Dog(name);
        element.textContent = `Dog: ${name}`;
        element.classList.add('dog');
    } else {
        const name = getRandomCowName();
        animal = new Cow(getRandomCowName());
        element.textContent = `Cow: ${name}`;
        element.classList.add('cow');
    }

    // Objekt in animals einfügen
    element.dataset.animalId = id;
    animals.push(animal);

    main.appendChild(element);
}

function onMainClick(event) {
    // HÜ: Mittels data attribute das geklickte Tier-Objekt finden 
    // Ausgabe von Tiername (name) und Tierlaut (talk())
    const id = parseInt(event.target.dataset.animalId);

    output.textContent = animals[id].talk();
}

const createButton = document.querySelector('#create-button');
createButton.addEventListener('click', onCreateButtonClick);

main.addEventListener('click', onMainClick);
