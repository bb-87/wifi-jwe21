// Queue

// const queue = [];

// function enqueue(element) {
//     queue.push(element);
// }

// function dequeue() {
//     return queue.shift();
// }

let queue = new Queue('Queue', ' - '); // new Queue() ruft code unter constructor bei Klasse Queue auf 

function onEnqueueButtonClick() {
    const elem = document.querySelector('#enqueue-value').value;

    queue.enqueue(elem);
    showQueue();
}

function onDequeueButtonClick() {
    const elem = queue.dequeue();

    const output = document.querySelector('#dequeue-value');

    if (elem !== undefined) {
        output.classList.remove('warning');
        // entspricht $("#dequeue-value").html("..."):
        output.innerText = 'Wert: ' + elem;
    }
    else {
        output.classList.add('warning');
        output.innerText = 'Eine leere Queue kann kein dequeue!';
    }

    showQueue();
}

function showQueue() {
    showDataStructure('queue', queue);
}

/** Klassen-Dokumentation (welcher Datentyp wird erwartet)
 * 
 * @param {string} id The ID of the HTML element
 * @param {List} data_structure The data structure to show (object of class List)
 */
function showDataStructure(id, data_structure) {
    const div = document.querySelector('#' + id);
    div.querySelector('.output').textContent = data_structure.toString();
}

document.querySelector('#enqueue-button').addEventListener('click', onEnqueueButtonClick);
document.querySelector('#dequeue-button').addEventListener('click', onDequeueButtonClick);


// Stack

// const stack = [];

// function push(element) {
//     stack.push(element);
// }

// function pop() {
//     return stack.pop();
// }

let stack = new Stack('Stack', ' | ');

function showStack() {
    showDataStructure('stack', stack);
}

function onPushButtonClick() {
    const inputVal = document.querySelector('#push-value').value;

    stack.push(inputVal);
    showStack();
}

function onPopButtonClick() {
    const elem = stack.pop();

    const output = document.querySelector('#pop-value');

    if (elem !== undefined) {
        output.classList.remove('warning');
        output.innerText = 'Wert: ' + elem;
    } else {
        output.classList.add('warning');
        output.innerText = 'Ein leerer Stack kann kein pop!';
    }

    showStack();
}

document.querySelector('#push-button').addEventListener('click', onPushButtonClick);
document.querySelector('#pop-button').addEventListener('click', onPopButtonClick);