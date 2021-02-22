// Variable definieren
var ganzZahl = 4;
// ausgabe in dev tools console:
// console.log(ganzZahl);

ganzZahl = 5;
// console.log(ganzZahl);

ganzZahl = 5 + 4;
// console.log(ganzZahl);

ganzZahl = 4 + ganzZahl * 2.5;
// console.log(ganzZahl);


var aufsteigendeZahl = 1;
// console.log(aufsteigendeZahl);

aufsteigendeZahl++;
// console.log(aufsteigendeZahl);


var absteigendeZahl = 0;
absteigendeZahl--;
// console.log(absteigendeZahl);


var zahlAlsText = "3e";
// console.log(zahlAlsText);
// console.log(typeof zahlAlsText);

zahlAlsText = parseInt(zahlAlsText);
// console.log(zahlAlsText);
// console.log(typeof zahlAlsText);

// console.log(zahlAlsText * 3);


var number1 = 2.5;
var number2 = 7;

// console.log(number1 * number2);


var spruch = 'Hallo, ';
// console.log(spruch);

spruch = spruch + 'Welt!';
// console.log(spruch);

spruch = '<=[' + spruch + ']=-';
// console.log(spruch);


// achtung bei schreibweisen von " und '
var inputFeld1 = '<input type="text" value="test">';
var inputFeld2 = "<input type=\"text\" value=\"test\">";
// console.log(inputFeld1, inputFeld2);


// zum bestehenden html konstrukt hinzufügen (veraltet, vermeiden)
// document.write('hallo');
// document.write('<br> ich bin eine neue Code-Zeile');


// array
var farben = [
    'rot',
    'gelb',
    'grün'
];

// console.log(farben.join(' | '));

// console.log(farben[2]); // gibt speicherplatz [2] aus


var katalog = [
    'Inhaltsverzeichnis',
     [
         'Absatz 1',
         'Absatz 2'
     ],
    'Kapitel 2',
    'Kapitel 3'
]

// console.log(katalog);

// letztes element in array entfernen
katalog.pop();

// element zu array am ende hinzufügen
katalog.push('Kapitel 4');

// console.log(katalog);

// tiefere ebene ansprechen
// console.log(katalog[1][0]);

// speicherplatz in array überschreiben 
katalog[0] = katalog[0] + ' NEU';
// console.log(katalog);


/*
    mehrzeiligen kommentar
    einfügen
*/



var speicherplatzzugriffsname = 'groesse'

// objekt
var ich = {
    vorname: 'Bernhard',
    nachname: 'Berger',
    groesse: '181cm',
    alter: 33,

    kopf: {
        augen: 'blau-grau',
        haare: 'kaum vorhanden'
    }
};

// console.log('Hallo, ich bin ' + ich.vorname + '!');
// console.log('Aktuell bin ich ' + ich.alter + ' Jahre alt.');
// console.log('Meine Augen sind ' + ich.kopf.augen + '.');
// console.log(ich['vorname']);
// console.log(ich[speicherplatzzugriffsname]);


// Konstante definieren
const USER_NAME = 'bernhard'

console.log(USER_NAME);


// Variable, allerdings nicht global gültig, sondern lokal eingegrenzt (scope)
let example1 = 'hui';

// Geschützter Bereich (scope) {}
{
    let example1 = 'jump';

    console.log(example1);
}

// console.log(example1);