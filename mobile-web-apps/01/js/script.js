function calculate() {
    // Eingabe in 2 Variablen einlesen und Operator einlesen
    const num1 = parseFloat(document.getElementById('num1').value); // "2" und nicht 2 -> parseInt (parseFloat für Dezimalzahlen)
    const num2 = parseFloat(document.getElementById('num2').value);
    const operator = document.getElementById('operator').value;

    // Berechnung und speichern in einer dritte Variable

    var result;

    if (operator == '+') {
        result = num1 + num2;
    } else if (operator == '-') {
        result = num1 - num2;
    } else if (operator == '*') {
        result = num1 * num2;
    } else if (operator == '/') {
        result = num1 / num2;
    }

    // Ausgabe
    document.getElementById('result').value = result;
}

const button = document.getElementById('button-calc');

button.addEventListener('click', calculate);