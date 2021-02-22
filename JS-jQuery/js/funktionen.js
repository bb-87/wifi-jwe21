let userNameFromDatabase = 'Roland';

function sayMyName(name) {
    if(checkMyInput(name) == true) {
        console.log('Your name is ' + name);
    }
}

function checkMyInput(input)  {
    if(typeof input == 'string') {
        // console.log('yes, it is a string');
        return true;
    } else {
        // console.log('Your input is not a name');
        return false;
    }
}

sayMyName('Bernhard');
sayMyName('Manuel');
sayMyName('Thomas');
sayMyName(userNameFromDatabase);

let ergebnisMeinerFunktion = sayMyName('Jasmin');