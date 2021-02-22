// true
if(typeof 'apfel' == 'string') {

}

// true
if(1 > 0) {

}

// true
if(0 < 1) {

}

// true
if(1 == 1) {

}

// true
if(0 <= 1) {

}

// false
if(0 >= 1) {

}

// true
if(0 != 1) {

}

// true
if(!(0 == 1)) {

}

// false
if(1 < 5 && 9 == 14) {

}

// true
if(1 < 5 || 9 == 14) {

}

// true
if(1 == 1 || 2 > 1 || 4 == 6) {

}

// true
if(1 == 1 || (2 > 1 && 4 == 6)) {

}


// false
if('name' == 'name2') {

}

// true
if('name' .length < 5) {

}

// true (Vorsicht: stelle 0 vs stelle 1)
if('jasmin' .indexOf('a') == 1) {

}


let vorname = 'qendrim'

switch(vorname) {
    case 'roland':
        console.log('Ich bin Netflix Fan');
        break;

    case 'qendrim':
        console.log('Ich habe Coding für entdeckt');
        break;

    default:
        console.log('alles halb so wild :-)')
}