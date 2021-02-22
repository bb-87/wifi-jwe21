let f_username_valid = true;

let f_username = $('#username'); // f-prefix für form

// keyup = loslassen von Taste (vs. keydown)
f_username.keyup(function(){
    let f_username_valid = 0; // 3 is valid

    let wert = $(this).val(); // this bezieht sich hier auf f_username
    console.log('## Aktuelle Eingabe: ' + wert);

    // wert überprüfen - enthält zumindest einen Buchstaben und hat eine Länge vom zumindest 6 Zeichen
    // Rückgabewert bei einem Match ist ein Array ['gefundeneZeichenkette']
    console.log(wert.match(/[a-zA-Z]+/g)); // siehe regex
    if(wert.match(/[a-zA-Z]+/g) != null && wert.length > 5) {
        console.log('Ihr Benutzername enthält zumindest sechs Buchstaben. Gut!');
        f_username_valid++;
    } else {
        console.warn('Ihr Benutzername muss zumindest sechs Buchstaben enhalten.');
        f_username_valid = 0;
    }

    // Enthält kein Sonderzeichen
    // Würde es ein Sonderzeichen enthalten wäre der Rückgabewert ein Array ['gefundeneZeichenkette']
    console.log(wert.match(/[!@#$%\^&*(){}[\]<>?/|\-+]/));
    if(wert.match(/[!@#$%\^&*(){}[\]<>?/|\-+]/) == null) {
        console.log('Ihr Benutzername enthält kein Sonderzeichen. Das ist gut!')
        f_username_valid++;
    } else {
        console.warn('Ihr Benutzername enthält Sonderzeichen. Das ist schlecht!');
        f_username_valid = 0;
    }

    // Enthält kein Leerzeichen
    // Würde es ein Leerzeichen enthalten wäre der Rückgabewert ein Array ['gefundeneZeichenkette']
    console.log(wert.match(/\s/g));
    if(wert.match(/\s/g) == null) {
        console.log('Ihr Benutzername enthält keine Leerzeichen. Wunderbar!')
        f_username_valid++;
    } else {
        console.warn('Ihr Benutzername enthält Leerzeichen. Das ist nicht erwünscht!');
        f_username_valid = 0;
    }
});


// dynamische Ausgabe von HTML (Formularfelder)

let f_children = $('#children');
let f_children_age = $('#children_ages');

f_children.change(function() {
    // console.log($(this).val());

    // momentan ausgewählter Wert (Value) des Select-Feldes
    let amount = $(this).val();

    // Entfernen von (eventuell durch vorherige Auswahl eingefügtem) HTML
    f_children_age.html('');

    // Schleife verwendet 'amount' aus dem Select-Feld, um die Anzahl der Wiederholungen festzulegen
    for(let i = 0; i < amount; i++) {
        console.log('Kind ' + (i+1));

        let input = `<input type="text" id="child_${i+1}_age" class="form-control child-age" required>`;
        input = `<label for="child_${i+1}_age">Alter Kind ${i+1}:</label>` + input;
        input = `<div class="row child"><div class="col-md-3">` + input + `</div></div>`;

        f_children_age.append(input);
    }
});


// Zugriff auf die textarea 'message'
let message = $('#message');
let counter = $('#counter');

message.keyup(function() {
    let count = $(this).val().length;
    counter.html(count);
});


let f_submit = $('#checkoutSubmit');

let f_children_age_valid;

f_submit.click(function(e) {
    f_children_age_valid = 0;
    
    $('input.child-age').each(function() {
        let field = $(this);

        /*
            Der Inhalt (die Zeichenlänge) ist größer 0
            -> Das Feld wurde befüllt, daher wird die Variable um 1 erhöht
            -> Hier könnte noch eine explizite Prüfung für das Alter erfolgen
        */
        if(field.val()) {
            f_children_age_valid++;
        }
    });


    /*
        Ist die Zahl in 'f_children_age_valid' gleich hoch wie die Zahl in 'f_children.val()'
        UND 
        f_username_valid == 3
        dann ist der gesamte Ausdruck true und das Formular wird per .submit() abgeschickt
    */
    if(f_children_age_valid == f_children.val() && f_username_valid == 3) {
        $(this).closest('form').submit();
        return true;
    }

    // Durch das vorangestellte return true; wird der nachstehende Code nicht mehr ausgeführt

    e.preventDefault();
    return false;
});