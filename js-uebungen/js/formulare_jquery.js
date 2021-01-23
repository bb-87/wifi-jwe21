// !!! not working atm, solution on Manuel's github !!!

let f_username_valid = true;

let f_username = $('#username'); // f-prefix für form

// keyup = loslassen von Taste (vs. keydown)
f_username.keyup(function(){
    let f_username_valid = 0; // 3 is valid

    let wert = $(this).val(); // this bezieht sich hier auf f_username
    console.log(wert);

    // wert überprüfen - enthält zumindest einen Buchstabe und hat eine Länge vom zumindest 6 Zeichen
    // Rückgabewert bei einem Match ist ein Array ['gefundeneZeichenkette']
    console.log(wert.match(/[a-zA-Z]+/g)); // siehe regex
    if(wert.match(/[a-zA-Z]+/g) != null && wert.length > 5) {
        console.log('Ihr Benutzername enthält zumindest sechs Buchstaben. Gut!');
        f_username_valid++;
    } else {
        f_username_valid = 0;
    }

    // Enthält ein Sonderzeichen
    console.log(wert.match(/[!@#$%\^&*(){}[\]<>?/|\-+]/));
    if(wert.match(/[!@#$%\^&*(){}[\]<>?/|\-+]/) == null) {
        console.log('Ihr Benutzername enthält kein Sonderzeichen. Das ist gut!')
        f_username_valid++;
    } else {
        f_username_valid = 0;
    }

    // Enthält ein oder mehrere Leerzeichen
    console.log(wert.match(/\s/g));
    if(wert.match(/\s/g) == null) {
        console.log('Ihr Benutzername enthält keine Leerzeichen. Wunderbar!')
        f_username_valid++;
    } else {
        f_username_valid = 0;
    }
});

let f_submit = $('#checkoutSubmit');

f_submit.click(function(e) {
    if(f_username_valid > 0) {
        $(this).closest('form').submit();
        return true;
    }

    e.preventDefault();
    return false;
});