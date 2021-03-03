// Zugriff auf ein HTML Element
document.getElementById('number');
$('#number');
document.querySelector('#number');

// Zugriff auf mehrere Elemente
document.querySelectorAll('.important');
// #id, .class, button

// Click Event
// in HTML -> Problem: Vermischung von HTML und JavaScript, wird leicht unübersichtlich

let button = document.querySelector('button');

// Mit addEventListener EventListener hinzufügen, ohne Bestehende zu beeinflussen 
button.addEventListener('click', doSomething); // Bei einem Klick führt der Browser doSomething() aus
button.addEventListener('click', doSomething2);
button.addEventListener('click', doSomething3);

// Mit .onclick werden bestehende EventListener gelöscht
button.onclick = doSomething1;
button.onclick = doSomething2;
button.onclick = doSomething3; // letzte gewinnt

// Achtung, keine Klammern nach dem Funktionsnamen!
// Sonst würde die Funktion gleich beim Angeben des EventListener ausgeführt
// Falsch: button.onclick = doSomething();
// Falsch: button.addEventListener('click', doSomething3());

// Funktion 'greet' mit 2 Übergabeparametern 'name' und 'age'
function greet(name, age) {
    // Wenn die greet('Alex', 77); aufgerufen wird, werden die Übergabeparameter so gesetzt:
    // name = 'Alex'
    // age = 77
    console.log(`Hallo ${name} (${age})`);
}

// Funktion ohne Übergabeparameter
function goodbye() {
    console.log('Goodbye, Ruben');
}

greet('Alex', 77);

// Scopes von Variablen
function myFunction(name, age) {
    const height = 1.8;
    let weight;

    if (age > 80) {
        weight = 70;
    } else {
        weight = 100;
        var shoeSize = 36;
    }
}

// Sichtbarkeit:
// height: Zeilen 51 - 61 (Ende der Funktion)
// weight: Zeilen 52 - 61 (Ende der Funktion)
// name, age: Zeilen 50 (Beginn der Funktion) - 61 (Ende der Funktion)
// shoeSize: Zeilen 51- 61 (weil 'var' bedeutet, dass die Variable quasi in der 1. Zeile der Funktion definiert wird -> hoisting)

let global1, global2;

function A() {
    let A1, A2;
    console.log(global1); // sichtbar

    function B() {
        let B1, B2;
        console.log(A1);
        console.log(global1); // sichtbar
    }

    console.log(B1); // Fehler! -> undefined
}

// Sichtbarkeit:
// A1, A2: Zeilen 66 bis 77
// B1, B2: Zeilen 71 bis 74

// true, false
// 123 <- parseInt('123')
// 123.45 <- parseFloat('123.45')

// [] Listen (oder Arrays)
// {} Objects

// Klassen in JavaScript

// Queue, basierend auf einer Liste, mit den Methoden Array.push für enqueue und Array.unshift für dequeue
// FIFO-Prinzip: First In First Out

// Stack, basierend auf einer Liste, mit den Methoden push und pop
// LIFO-Prinzip: Last In First Out

// Sortieren von Werten in einer Liste mit der sort Methode und einer compare-Funktion

// Set, Map
